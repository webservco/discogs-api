<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsApi\Exceptions\ApiException;
use WebServCo\DiscogsApi\Interfaces\ThrottleInterface;
use WebServCo\DiscogsAuth\Interfaces\AuthInterface;
use WebServCo\Framework\Http\Method;
use WebServCo\Framework\Http\Response;
use WebServCo\Framework\Interfaces\HttpClientInterface;
use WebServCo\Framework\Interfaces\LoggerInterface;

final class Client implements \WebServCo\DiscogsApi\Interfaces\ApiInterface
{
    protected AuthInterface $authInterface;
    protected HttpClientInterface $httpClientInterface;
    protected LoggerInterface $loggerInterface;
    protected ThrottleInterface $throttleInterface;
    protected Settings $settings;

    public function __construct(
        AuthInterface $authInterface,
        HttpClientInterface $httpClientInterface,
        LoggerInterface $loggerInterface,
        ThrottleInterface $throttleInterface,
        Settings $settings
    ) {
        $this->settings = $settings;

        $this->httpClientInterface = $httpClientInterface;
        $this->loggerInterface = $loggerInterface;
        $this->throttleInterface = $throttleInterface;

        /* code below requires settings, browser */

        $this->httpClientInterface->setDebug((bool) $this->setting('debug'));
        $this->setUserAgentHeader();
        $this->setAcceptHeader();

        $this->setAuthInterface($authInterface);
    }

    public function get(string $endpoint): ApiResponse
    {
        return $this->call($endpoint, Method::GET);
    }

    /**
    * @param mixed $data
    */
    public function post(string $endpoint, $data = null): ApiResponse
    {
        return $this->call($endpoint, Method::POST, $data);
    }

    public function setAuthInterface(AuthInterface $authInterface): void
    {
        $this->authInterface = $authInterface;
    }

    /**
    * @return bool|string
    */
    public function setting(string $setting)
    {
        return $this->settings->get($setting);
    }

    /**
    * @param mixed $data
    */
    protected function call(string $endpoint, string $method, $data = null): ApiResponse
    {
        $url = \sprintf('%s%s', Url::API, $endpoint);
        if ($this->setting('rateLimiting')) {
            $this->throttleInterface->throttle();
        }
        switch ($method) {
            case Method::GET:
                break;
            case Method::POST:
                if ($data) {
                    if (\is_array($data)) {
                        $data = \json_encode($data);
                    }
                    $this->httpClientInterface->setRequestContentType('application/json');
                    $this->httpClientInterface->setRequestData($data);
                }
                break;
            default:
                throw new ApiException('Method not implemented.');
        }
        $this->httpClientInterface->setMethod($method);
        $this->setAuthorizationHeader();
        $response = $this->httpClientInterface->retrieve($url); // \WebServCo\Framework\Http\Response
        return $this->processResponse($endpoint, $method, $response);
    }

    protected function processResponse(string $endpoint, string $method, Response $response): ApiResponse
    {
        $apiResponse = new ApiResponse($endpoint, $method, $response); // \WebServCo\DiscogsApi\ApiResponse
        if ($this->setting('rateLimiting')) {
            $rateLimitRemaining = $apiResponse->getRateLimitRemaining();
            $this->throttleInterface->set($rateLimitRemaining);
        }

        $apiResponseHandler = new \WebServCo\DiscogsApi\ApiResponseHandler($apiResponse);
        return $apiResponseHandler->handle();
    }

    /*
    * Set Authorization header.
    * Called if the endpoint requires authorization.
    * All Discogs authorization types are supported.
    * Please see webservco/discogs-auth for options.
    * @link https://www.discogs.com/developers/#page:authentication
    * @return void
    */
    protected function setAuthorizationHeader(): void
    {
        $this->httpClientInterface->setRequestHeader('Authorization', $this->authInterface->getAuthHeader());
    }

    /*
    * Set Accept header.
    * @link https://www.discogs.com/developers/#page:home,header:home-versioning-and-media-types
    * @return void
    */
    protected function setAcceptHeader(): void
    {
        $this->httpClientInterface->setRequestHeader('Accept', \WebServCo\DiscogsApi\Versioning\V2\Accept::DISCOGS);
    }

    /*
    * Set User-Agent header.
    * @link https://www.discogs.com/developers/#page:home,header:home-general-information
    * @return void
    */
    protected function setUserAgentHeader(): void
    {
        $this->httpClientInterface->setRequestHeader('User-Agent', (string) $this->setting('userAgent'));
    }
}

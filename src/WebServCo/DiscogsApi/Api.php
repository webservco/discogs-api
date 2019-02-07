<?php
namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsApi\Exceptions\ApiException;
use WebServCo\DiscogsAuth\Interfaces\AuthInterface;
use WebServCo\Framework\Http\Method;

final class Api implements \WebServCo\DiscogsApi\Interfaces\ApiInterface
{
    protected $authInterface;
    protected $httpBrowserInterface;
    protected $loggerInterface;
    protected $throttleInterface;
    protected $settings;

    public function __construct(
        AuthInterface $authInterface,
        \WebServCo\Framework\Interfaces\HttpBrowserInterface $httpBrowserInterface,
        \WebServCo\Framework\Interfaces\LoggerInterface $loggerInterface,
        \WebServCo\DiscogsApi\Interfaces\ThrottleInterface $throttleInterface,
        Settings $settings
    ) {
        $this->settings = $settings;

        $this->httpBrowserInterface = $httpBrowserInterface;
        $this->loggerInterface = $loggerInterface;
        $this->throttleInterface = $throttleInterface;

        /* below requires settings, browser */

        $this->httpBrowserInterface->setDebug($this->setting('debug'));
        $this->setUserAgentHeader();
        $this->setAcceptHeader();

        $this->setAuthInterface($authInterface);
    }

    public function get($endpoint)
    {
        return $this->call($endpoint, Method::GET);
    }

    public function post($endpoint, $data = null)
    {
        return $this->call($endpoint, Method::POST, $data);
    }

    protected function call($endpoint, $method, $data = null)
    {
        $url = sprintf('%s%s', Url::API, $endpoint);
        if ($this->setting('rateLimiting')) {
            $this->throttleInterface->throttle();
        }
        switch ($method) {
            case Method::GET:
                break;
            case Method::POST:
                if (!empty($data)) {
                    if (is_array($data)) {
                        $data = json_encode($data);
                    }
                    $this->httpBrowserInterface->setRequestContentType('application/json');
                    $this->httpBrowserInterface->setRequestData($data);
                }
                break;
            default:
                throw new ApiException('Method not implemented.');
                break;
        }
        $this->httpBrowserInterface->setMethod($method);
        $this->setAuthorizationHeader();
        $response = $this->httpBrowserInterface->retrieve($url); // \WebServCo\Framework\Http\Response
        return $this->processResponse($endpoint, $method, $response);
    }

    public function setAuthInterface(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function setting($setting)
    {
        return $this->settings->get($setting);
    }

    protected function processResponse($endpoint, $method, \WebServCo\Framework\Http\Response $response)
    {
        $apiResponse = new ApiResponse($endpoint, $method, $response); // \WebServCo\DiscogsApi\ApiResponse
        if ($this->setting('rateLimiting')) {
            $rateLimitRemaining = $apiResponse->getRateLimitRemaining();
            $this->throttleInterface->set($rateLimitRemaining);
        }

        if ($this->setting('handleResponse')) {
            $apiResponseHandler = new \WebServCo\DiscogsApi\ApiResponseHandler($apiResponse);
            return $apiResponseHandler->handle();
        }
        return $apiResponse;
    }

    /*
    * Set Authorization header.
    * Called if the endpoint requires authorization.
    * All Discogs authorization types are supported.
    * Please see webservco/discogs-auth for options.
    * @link https://www.discogs.com/developers/#page:authentication
    * @return void
    */
    protected function setAuthorizationHeader()
    {
        $this->httpBrowserInterface->setRequestHeader('Authorization', $this->authInterface->getAuthHeader());
    }

    /*
    * Set Accept header.
    * @link https://www.discogs.com/developers/#page:home,header:home-versioning-and-media-types
    * @return void
    */
    protected function setAcceptHeader()
    {
        $this->httpBrowserInterface->setRequestHeader('Accept', \WebServCo\DiscogsApi\Versioning\V2\Accept::DISCOGS);
    }

    /*
    * Set User-Agent header.
    * @link https://www.discogs.com/developers/#page:home,header:home-general-information
    * @return void
    */
    protected function setUserAgentHeader()
    {
        $this->httpBrowserInterface->setRequestHeader('User-Agent', $this->setting('userAgent'));
    }
}

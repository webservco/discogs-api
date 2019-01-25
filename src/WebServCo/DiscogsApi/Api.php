<?php
namespace WebServCo\DiscogsApi;

final class Api implements \WebServCo\DiscogsApi\Interfaces\ApiInterface
{
    protected $authInterface;
    protected $httpBrowserInterface;
    protected $loggerInterface;
    protected $userAgent;

    public function __construct(
        \WebServCo\DiscogsAuth\Interfaces\AuthInterface $authInterface,
        \WebServCo\Framework\Interfaces\HttpBrowserInterface $httpBrowserInterface,
        \WebServCo\Framework\Interfaces\LoggerInterface $loggerInterface,
        $userAgent
    ) {
        $this->authInterface = $authInterface;
        $this->httpBrowserInterface = $httpBrowserInterface;
        $this->loggerInterface = $loggerInterface;
        $this->userAgent = $userAgent;

        $this->setUserAgentHeader();
        $this->setAcceptHeader();
        $this->setAuthorizationHeader();
    }

    public function get($endpoint)
    {
        throw new \WebServCo\DiscogsApi\Exceptions\DiscogsApiException('Functionality not implemented.');
    }

    public function post($endpoint, $data)
    {
        throw new \WebServCo\DiscogsApi\Exceptions\DiscogsApiException('Functionality not implemented.');
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
        $this->httpBrowserInterface->setRequestHeader('User-Agent', $this->userAgent);
    }
}

<?php
namespace WebServCo\DiscogsApi;

final class Api implements \WebServCo\DiscogsApi\Interfaces\ApiInterface
{
    protected $authInterface;
    protected $httpBrowserInterface;
    protected $loggerInterface;
    protected $settings;

    public function __construct(
        \WebServCo\DiscogsAuth\Interfaces\AuthInterface $authInterface,
        \WebServCo\Framework\Interfaces\HttpBrowserInterface $httpBrowserInterface,
        \WebServCo\Framework\Interfaces\LoggerInterface $loggerInterface,
        Settings $settings
    ) {
        $this->authInterface = $authInterface;
        $this->httpBrowserInterface = $httpBrowserInterface;
        $this->loggerInterface = $loggerInterface;
        $this->settings = $settings;

        $this->httpBrowserInterface->setDebug($this->setting('debug'));

        $this->setUserAgentHeader();
        $this->setAcceptHeader();
        $this->setAuthorizationHeader();
    }

    public function get($endpoint)
    {
        $url = sprintf('%s%s', Url::API, $endpoint);
        //XXX TODO HANDLE RATE LIMITING
        return $this->httpBrowserInterface->get($url);
    }

    public function post($endpoint, $data)
    {
        //XXX TODO HANDLE RATE LIMITING
        throw new \WebServCo\DiscogsApi\Exceptions\ApiException('Functionality not implemented.');
    }

    public function setting($setting)
    {
        return $this->settings->get($setting);
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

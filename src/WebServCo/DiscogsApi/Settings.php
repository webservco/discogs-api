<?php
namespace WebServCo\DiscogsApi;

final class Settings
{
    protected $debug;
    protected $handleResponse;
    protected $userAgent;

    public function __construct($debug, $handleResponse, $userAgent)
    {
        $this->debug = (bool) $debug;
        $this->handleResponse = (bool) $handleResponse;
        $this->userAgent = $userAgent;
    }

    public function get($setting)
    {
        if (!property_exists($this, $setting)) {
            throw new \InvalidArgumentException('Invalid parameter specified');
        }
        return $this->$setting;
    }
}

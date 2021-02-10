<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi;

final class Settings
{
    protected $debug;
    protected $handleResponse;
    protected $rateLimiting;
    protected $userAgent;

    public function __construct($debug, $handleResponse, $rateLimiting, $userAgent)
    {
        $this->debug = (bool) $debug;
        $this->handleResponse = (bool) $handleResponse;
        $this->rateLimiting = $rateLimiting;
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

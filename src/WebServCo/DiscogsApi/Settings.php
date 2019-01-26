<?php
namespace WebServCo\DiscogsApi;

final class Settings
{
    protected $debug;
    protected $processResponse;
    protected $userAgent;

    public function __construct($debug, $processResponse, $userAgent)
    {
        $this->debug = (bool) $debug;
        $this->processResponse = (bool) $processResponse;
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

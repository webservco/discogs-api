<?php
namespace WebServCo\DiscogsApi;

final class Settings
{
    protected $processResponse;
    protected $userAgent;

    public function __construct($processResponse, $userAgent)
    {
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

<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi;

final class Settings
{

    protected bool $debug;
    protected bool $rateLimiting;
    protected string $userAgent;

    public function __construct(bool $debug, bool $rateLimiting, string $userAgent)
    {
        $this->debug = $debug;
        $this->rateLimiting = $rateLimiting;
        $this->userAgent = $userAgent;
    }

    /**
    * @return bool|string
    */
    public function get(string $setting)
    {
        if (!\property_exists($this, $setting)) {
            throw new \InvalidArgumentException('Invalid parameter specified');
        }
        return $this->$setting;
    }
}

<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsApi\Exceptions\ApiException;

final class RateLimiter implements \WebServCo\DiscogsApi\Interfaces\ThrottleInterface
{

    protected $filePath;

    public function __construct($workDir)
    {
        if (!\is_readable($workDir)) {
            throw new ApiException('Work directory not readable');
        }
        if (!\is_writable($workDir)) {
            throw new ApiException('Work directory not writeable');
        }
        $filePath = \sprintf('%sDiscogsApiRateLimiter', $workDir);
        try {
            // make sure the file exists and is writable, but don't actually write in it.
            \touch($filePath);
        } catch (\Throwable $e) {
            throw new ApiException('Error writing in work directory');
        }
        $this->filePath = $filePath;
    }

    public function get()
    {
        return (int) \file_get_contents($this->filePath);
    }

    public function set($value): void
    {
        \file_put_contents($this->filePath, $value);
    }

    public function throttle()
    {
        $value = $this->get();

        if (1 === $value) {
            // only one request left, wait for request window reset
            \sleep(60);
            return true;
        }
        return false;
    }
}

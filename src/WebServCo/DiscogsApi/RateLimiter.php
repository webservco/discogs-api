<?php
namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsApi\Exceptions\ApiException;

final class RateLimiter implements \WebServCo\Framework\Interfaces\ThrottleInterface
{
    protected $workDir;

    public function __construct($workDir)
    {
        if (!is_readable($workDir)) {
            throw new ApiException('Work directory not readable');
        }
        if (!is_writable($workDir)) {
            throw new ApiException('Work directory not writeable');
        }
        $this->workDir = $workDir;
    }
}

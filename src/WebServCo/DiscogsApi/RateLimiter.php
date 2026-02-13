<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi;

use Throwable;
use WebServCo\DiscogsApi\Exceptions\ApiException;
use WebServCo\DiscogsApi\Interfaces\ThrottleInterface;

use function file_get_contents;
use function file_put_contents;
use function is_readable;
use function is_writable;
use function sleep;
use function sprintf;
use function touch;

final class RateLimiter implements ThrottleInterface
{
    protected string $filePath;

    public function __construct(string $workDir)
    {
        if (!is_readable($workDir)) {
            throw new ApiException('Work directory not readable');
        }
        if (!is_writable($workDir)) {
            throw new ApiException('Work directory not writeable');
        }
        $filePath = sprintf('%sDiscogsApiRateLimiter', $workDir);
        try {
            // make sure the file exists and is writable, but don't actually write in it.
            touch($filePath);
        } catch (Throwable) {
            throw new ApiException('Error writing in work directory');
        }
        $this->filePath = $filePath;
    }

    public function get(): int
    {
        return (int) file_get_contents($this->filePath);
    }

    public function set(int $value): void
    {
        file_put_contents($this->filePath, $value);
    }

    public function throttle(): bool
    {
        $value = $this->get();

        if ($value === 1) {
            // only one request left, wait for request window reset
            sleep(60);

            return true;
        }

        return false;
    }
}

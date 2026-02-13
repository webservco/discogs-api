<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi;

use InvalidArgumentException;

use function property_exists;

final class Settings
{
    public function __construct(protected bool $debug, protected bool $rateLimiting, protected string $userAgent)
    {
    }

    public function get(string $setting): bool|string
    {
        if (!property_exists($this, $setting)) {
            throw new InvalidArgumentException('Invalid parameter specified');
        }

        return $this->$setting;
    }
}

<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Interfaces;

interface ThrottleInterface
{

    public function set(int $value): void;

    public function throttle(): bool;
}

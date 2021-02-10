<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Interfaces;

interface ThrottleInterface
{

    public function set($value);

    public function throttle();
}

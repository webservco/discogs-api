<?php
namespace WebServCo\DiscogsApi\Interfaces;

interface ThrottleInterface
{
    public function set($value);
    public function throttle();
}

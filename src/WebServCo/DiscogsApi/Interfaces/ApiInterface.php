<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Interfaces;

use WebServCo\DiscogsApi\ApiResponse;
use WebServCo\DiscogsAuth\Interfaces\AuthInterface;

interface ApiInterface
{
    public function get(string $endpoint): ApiResponse;

    public function post(string $endpoint, mixed $data = null): ApiResponse;

    public function setAuthInterface(AuthInterface $authInterface): void;
}

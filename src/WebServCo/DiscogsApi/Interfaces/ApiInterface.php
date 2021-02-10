<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Interfaces;

use WebServCo\DiscogsApi\ApiResponse;

interface ApiInterface
{

    public function get(string $endpoint): ApiResponse;

    /**
    * @param mixed $data
    */
    public function post(string $endpoint, $data = null): ApiResponse;
}

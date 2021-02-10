<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Interfaces;

interface ApiInterface
{

    public function get($endpoint);

    public function post($endpoint, $data = null);
}

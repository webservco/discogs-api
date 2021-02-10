<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Api;

use WebServCo\DiscogsApi\Interfaces\ApiInterface;

abstract class AbstractApi
{

    protected ApiInterface $api;

    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }
}

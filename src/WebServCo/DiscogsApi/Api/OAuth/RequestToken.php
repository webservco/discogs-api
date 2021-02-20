<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\OAuth;

final class RequestToken extends \WebServCo\DiscogsApi\Api\AbstractApi
{

    public function get(): \WebServCo\DiscogsApi\ApiResponse
    {
        return $this->api->get('oauth/request_token');
    }
}

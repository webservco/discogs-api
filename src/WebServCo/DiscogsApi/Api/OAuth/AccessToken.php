<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\OAuth;

use WebServCo\DiscogsApi\Api\AbstractApi;
use WebServCo\DiscogsApi\ApiResponse;

final class AccessToken extends AbstractApi
{
    public function post(): ApiResponse
    {
        return $this->api->post('oauth/access_token');
    }
}

<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\OAuth;

use WebServCo\DiscogsApi\Api\AbstractApi;
use WebServCo\DiscogsApi\ApiResponse;

final class Identity extends AbstractApi
{
    public function get(): ApiResponse
    {
        return $this->api->get('oauth/identity');
    }
}

<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Api\OAuth;

final class AccessToken extends \WebServCo\DiscogsApi\Api\AbstractApi
{

    public function post()
    {
        return $this->api->post('oauth/access_token');
    }
}

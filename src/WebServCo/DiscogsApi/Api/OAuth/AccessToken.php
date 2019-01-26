<?php
namespace WebServCo\DiscogsApi\Api\OAuth;

final class AccessToken extends \WebServCo\DiscogsApi\Api\AbstractApi
{
    public function post()
    {
        $response = $this->api->post('oauth/access_token');

        return $this->api->processResponse($response);
    }
}

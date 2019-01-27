<?php
namespace WebServCo\DiscogsApi\Api\OAuth;

final class RequestToken extends \WebServCo\DiscogsApi\Api\AbstractApi
{
    public function get()
    {
        return $this->api->get('oauth/request_token');
    }
}

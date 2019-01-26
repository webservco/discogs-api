<?php
namespace WebServCo\DiscogsApi\Api\OAuth;

final class Identity extends \WebServCo\DiscogsApi\Api\AbstractApi
{
    public function get()
    {
        $response = $this->api->get('oauth/identity');

        return $this->api->processResponse($response);
    }
}

<?php
namespace WebServCo\DiscogsApi\Api\OAuth;

final class Identity extends \WebServCo\DiscogsApi\Api\AbstractApi
{
    public function get()
    {
        return $this->api->get('oauth/identity');
    }
}

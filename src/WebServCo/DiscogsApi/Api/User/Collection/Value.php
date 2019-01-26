<?php
namespace WebServCo\DiscogsApi\Api\User\Collection;

final class Value extends \WebServCo\DiscogsApi\Api\User\AbstractUser
{
    public function get()
    {
        $response = $this->api->get(sprintf('users/%s/collection/value', $this->username));

        return $this->api->processResponse($response);
    }
}

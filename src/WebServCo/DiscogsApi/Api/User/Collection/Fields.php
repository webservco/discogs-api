<?php
namespace WebServCo\DiscogsApi\Api\User\Collection;

final class Fields extends \WebServCo\DiscogsApi\Api\User\AbstractUser
{
    public function get()
    {
        $response = $this->api->get(sprintf('users/%s/collection/fields', $this->username));

        return $this->api->processResponse($response);
    }
}

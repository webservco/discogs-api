<?php
namespace WebServCo\DiscogsApi\Api\User\Identity;

final class Profile extends \WebServCo\DiscogsApi\Api\User\AbstractUser
{
    public function get()
    {
        return $this->api->get(sprintf('users/%s', $this->username));
    }

    public function post()
    {
        throw new \WebServCo\DiscogsApi\Exceptions\ApiException('Functionality not implemented.');
    }
}

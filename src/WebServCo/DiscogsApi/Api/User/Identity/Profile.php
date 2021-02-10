<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Api\User\Identity;

final class Profile extends \WebServCo\DiscogsApi\Api\User\AbstractUser
{

    public function get()
    {
        return $this->api->get(\sprintf('users/%s', $this->username));
    }

    public function post(): void
    {
        throw new \WebServCo\DiscogsApi\Exceptions\ApiException('Functionality not implemented.');
    }
}

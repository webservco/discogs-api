<?php
namespace WebServCo\DiscogsApi\Api\User\Identity;

final class Profile extends \WebServCo\DiscogsApi\Api\User\AbstractUser
{
    public function get()
    {
        $response = $this->api->get(sprintf('users/%s', $this->username));

        return $this->api->processResponse($response);
    }

    public function post()
    {
        throw new \WebServCo\DiscogsApi\Exceptions\ApiException('Functionality not implemented.');
    }
}

<?php
namespace WebServCo\DiscogsApi\User\Identity;

final class Profile extends \WebServCo\DiscogsApi\User\AbstractUser
{
    public function get()
    {
        $response = $this->api->get(sprintf('users/%s', $this->username));

        if ($this->api->setting('processResponse')) {
            $responseHandler = new \WebServCo\DiscogsApi\ResponseHandler($response);
            return $responseHandler->handle();
        }
        return $response;
    }

    public function post()
    {
        throw new \WebServCo\DiscogsApi\Exceptions\ApiException('Functionality not implemented.');
    }
}

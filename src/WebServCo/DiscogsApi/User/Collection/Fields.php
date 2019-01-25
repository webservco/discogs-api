<?php
namespace WebServCo\DiscogsApi\User\Collection;

final class Fields extends \WebServCo\DiscogsApi\User\AbstractUser
{
    public function get()
    {
        $response = $this->api->get(sprintf('users/%s/collection/fields', $this->username));

        if ($this->api->setting('processResponse')) {
            $responseHandler = new \WebServCo\DiscogsApi\ResponseHandler($response);
            return $responseHandler->handle();
        }
        return $response;
    }
}

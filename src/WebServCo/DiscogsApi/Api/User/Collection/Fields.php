<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Api\User\Collection;

final class Fields extends \WebServCo\DiscogsApi\Api\User\AbstractUser
{

    public function get()
    {
        return $this->api->get(\sprintf('users/%s/collection/fields', $this->username));
    }
}

<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\User\Collection;

final class Value extends \WebServCo\DiscogsApi\Api\User\AbstractUser
{

    public function get(): \WebServCo\DiscogsApi\ApiResponse
    {
        return $this->api->get(\sprintf('users/%s/collection/value', $this->username));
    }
}

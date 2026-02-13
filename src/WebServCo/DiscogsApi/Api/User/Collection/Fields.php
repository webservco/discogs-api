<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\User\Collection;

use WebServCo\DiscogsApi\Api\User\AbstractUser;
use WebServCo\DiscogsApi\ApiResponse;

use function sprintf;

final class Fields extends AbstractUser
{
    public function get(): ApiResponse
    {
        return $this->api->get(sprintf('users/%s/collection/fields', $this->username));
    }
}

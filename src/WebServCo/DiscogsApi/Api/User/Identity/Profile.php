<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\User\Identity;

use WebServCo\DiscogsApi\Api\User\AbstractUser;
use WebServCo\DiscogsApi\ApiResponse;
use WebServCo\DiscogsApi\Exceptions\ApiException;

use function sprintf;

final class Profile extends AbstractUser
{
    public function get(): ApiResponse
    {
        return $this->api->get(sprintf('users/%s', $this->username));
    }

    public function post(): void
    {
        throw new ApiException('Functionality not implemented.');
    }
}

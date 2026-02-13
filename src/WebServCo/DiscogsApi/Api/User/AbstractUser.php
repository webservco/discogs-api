<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\User;

use WebServCo\DiscogsApi\Interfaces\ApiInterface;

abstract class AbstractUser
{
    public function __construct(protected ApiInterface $api, protected string $username)
    {
    }
}

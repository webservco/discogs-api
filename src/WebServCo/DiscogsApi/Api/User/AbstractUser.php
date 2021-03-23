<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api\User;

use WebServCo\DiscogsApi\Interfaces\ApiInterface;

abstract class AbstractUser
{

    protected ApiInterface $api;
    protected string $username;

    public function __construct(ApiInterface $api, string $username)
    {
        $this->api = $api;
        $this->username = $username;
    }
}

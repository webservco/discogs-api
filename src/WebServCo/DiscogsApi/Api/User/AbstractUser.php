<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Api\User;

abstract class AbstractUser
{

    protected $api;
    protected $username;

    public function __construct(\WebServCo\DiscogsApi\Interfaces\ApiInterface $api, $username)
    {
        $this->api = $api;
        $this->username = $username;
    }
}

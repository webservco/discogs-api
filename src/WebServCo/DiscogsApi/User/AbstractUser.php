<?php
namespace WebServCo\DiscogsApi\User;

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

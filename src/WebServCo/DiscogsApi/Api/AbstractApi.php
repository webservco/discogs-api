<?php
namespace WebServCo\DiscogsApi\Api;

abstract class AbstractApi
{
    protected $api;

    public function __construct(\WebServCo\DiscogsApi\Interfaces\ApiInterface $api)
    {
        $this->api = $api;
    }
}

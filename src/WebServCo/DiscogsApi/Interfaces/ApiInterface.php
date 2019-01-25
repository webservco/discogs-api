<?php
namespace WebServCo\DiscogsApi\Interfaces;

interface ApiInterface
{
    public function get($endpoint);

    public function post($endpoint, $data);
}

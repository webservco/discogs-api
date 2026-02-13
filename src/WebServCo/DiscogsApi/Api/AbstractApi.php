<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Api;

use WebServCo\DiscogsApi\Interfaces\ApiInterface;

abstract class AbstractApi
{
    public function __construct(protected ApiInterface $api)
    {
    }
}

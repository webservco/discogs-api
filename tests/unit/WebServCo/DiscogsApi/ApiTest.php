<?php
namespace Tests\DiscogsApi;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsApi\Api;

final class ApiTest extends TestCase
{
    /**
     * @test
     */
    public function dummyPassingTest()
    {
        $api = new Api();
        $this->assertTrue($api instanceof Api);
    }
}

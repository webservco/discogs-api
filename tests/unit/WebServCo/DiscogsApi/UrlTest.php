<?php
namespace Tests\DiscogsApi;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsApi\Url;

final class UrlTest extends TestCase
{
    /**
     * @test
     */
    public function apiUrlMatches()
    {
        $this->assertEquals(URL::API, 'https://api.discogs.com/');
    }

    /**
     * @test
     */
    public function webUrlMatches()
    {
        $this->assertEquals(URL::WEB, 'https://www.discogs.com/');
    }
}

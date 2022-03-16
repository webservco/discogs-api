<?php

declare(strict_types=1);

namespace Tests\DiscogsApi;

use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsApi\Url;

final class UrlTest extends TestCase
{
    /**
     * @test
     */
    public function apiUrlMatches(): void
    {
        $this->assertEquals(Url::API, 'https://api.discogs.com/');
    }

    /**
     * @test
     */
    public function webUrlMatches(): void
    {
        $this->assertEquals(Url::WEB, 'https://www.discogs.com/');
    }
}

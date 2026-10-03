<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsApi;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsApi\Url;

final class UrlTest extends TestCase
{
    #[Test]
    public function apiUrlMatches(): void
    {
        $this->assertEquals(Url::API, 'https://api.discogs.com/');
    }

    #[Test]
    public function webUrlMatches(): void
    {
        $this->assertEquals(Url::WEB, 'https://www.discogs.com/');
    }
}

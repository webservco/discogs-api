<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Versioning\V2;

class Accept
{
    public const HTML = 'application/vnd.discogs.v2.html+json';
    public const DISCOGS = 'application/vnd.discogs.v2.discogs+json';
    public const PLAINTEXT = 'application/vnd.discogs.v2.plaintext+json';
}

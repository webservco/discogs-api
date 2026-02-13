<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Versioning\V2;

final class Accept
{
    public const string HTML = 'application/vnd.discogs.v2.html+json';
    public const string DISCOGS = 'application/vnd.discogs.v2.discogs+json';
    public const string PLAINTEXT = 'application/vnd.discogs.v2.plaintext+json';
}

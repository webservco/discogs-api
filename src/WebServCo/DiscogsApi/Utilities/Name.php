<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Utilities;

use function preg_replace;
use function sprintf;
use function trim;

final class Name
{
    /**
    * Prefixes.
    *
    * @var array<int,string>
    */
    protected array $prefixes;

    /**
    * Prefixes.
    *
    * @param array<int,string> $prefixes
    */
    public function __construct(array $prefixes = [])
    {
        $this->prefixes = $prefixes;
    }

    public function removeNumbering(string $data): string
    {
        // remove numbering
        $result = preg_replace('/\([0-9]+\)/', '', $data);

        return trim((string) $result);
    }

    public function removePrefixes(string $data): string
    {
        $patterns = [];
        foreach ($this->prefixes as $item) {
            $patterns[] = sprintf('/^%s /i', $item);
        }

        return (string) preg_replace($patterns, '', $data);
    }
}

<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

use WebServCo\DiscogsApi\Interfaces\ParserInterface;

use function array_unique;
use function implode;
use function is_array;

final class Labels implements ParserInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        $labels = [];
        if (is_array($data)) {
            foreach ($data as $item) {
                $labels[] = Label::parse($item);
            }
            // Remove duplicates (same label can appear multiple times on the same release).
            $labels = array_unique($labels);
            $result = implode(', ', $labels);
        }

        return $result;
    }
}

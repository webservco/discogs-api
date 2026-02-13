<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

use WebServCo\DiscogsApi\Interfaces\ParserInterface;

use function implode;
use function is_array;

final class CatNos implements ParserInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        $catnos = [];
        if (is_array($data)) {
            foreach ($data as $item) {
                $catnos[] = CatNo::parse($item);
            }
            $result = implode(', ', $catnos);
        }

        return $result;
    }
}

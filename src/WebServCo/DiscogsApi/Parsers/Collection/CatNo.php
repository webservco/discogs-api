<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

use WebServCo\DiscogsApi\Interfaces\ParserInterface;

final class CatNo implements ParserInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        if (isset($data['entity_type']) && isset($data['name'])) {
            // label
            if ((int) $data['entity_type'] === 1) {
                if (!empty($data['catno'])) {
                    $result = $data['catno'];
                }
            }
        }

        return $result;
    }
}

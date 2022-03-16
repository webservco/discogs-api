<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class CatNo implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        if (isset($data['entity_type']) && isset($data['name'])) {
            if (1 === (int) $data['entity_type']) { // label
                if (!\WebServCo\Framework\Helpers\StringHelper::isEmpty((string) $data['catno'])) {
                    $result = $data['catno'];
                }
            }
        }
        return $result;
    }
}

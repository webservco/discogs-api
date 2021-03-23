<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class Formats implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{

    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        $formats = [];
        if (\is_array($data)) {
            foreach ($data as $item) {
                $formats[] = \WebServCo\DiscogsApi\Parsers\Collection\Format::parse($item);
            }
            $result = \implode(' + ', $formats);
        }
        return $result;
    }
}

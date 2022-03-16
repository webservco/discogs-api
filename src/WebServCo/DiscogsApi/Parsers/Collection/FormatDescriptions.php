<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class FormatDescriptions implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        return \implode(', ', $data);
    }
}

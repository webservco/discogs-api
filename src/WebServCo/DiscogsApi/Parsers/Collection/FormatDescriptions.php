<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class FormatDescriptions implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{

    public static function parse($data)
    {
        if (\is_array($data)) {
            return \implode(', ', $data);
        }
        return null;
    }
}

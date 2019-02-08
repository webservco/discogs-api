<?php
namespace WebServCo\DiscogsApi\Parsers;

final class Name implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    public static function parse($data)
    {
        $result = preg_replace('/\([0-9]+\)/', '', (string) $data);
        return trim((string) $result);
    }
}

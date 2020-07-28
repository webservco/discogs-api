<?php
namespace WebServCo\DiscogsApi\Parsers\Collection;

final class CatNos implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    public static function parse($data)
    {
        $result = null;
        $catnos = [];
        if (is_array($data)) {
            foreach ($data as $item) {
                $catnos[] = \WebServCo\DiscogsApi\Parsers\Collection\CatNo::parse($item);
            }
            $result = implode(', ', $catnos);
        }
        return $result;
    }
}

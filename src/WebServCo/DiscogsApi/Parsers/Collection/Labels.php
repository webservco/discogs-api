<?php
namespace WebServCo\DiscogsApi\Parsers\Collection;

final class Labels implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    public static function parse($data)
    {
        $result = null;
        $labels = [];
        if (is_array($data)) {
            foreach ($data as $item) {
                $labels[] = \WebServCo\DiscogsApi\Parsers\Collection\Label::parse($item);
            }
            $result = implode(', ', $labels);
        }
        return $result;
    }
}

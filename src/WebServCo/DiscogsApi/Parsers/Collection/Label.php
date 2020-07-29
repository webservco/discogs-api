<?php
namespace WebServCo\DiscogsApi\Parsers\Collection;

final class Label implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    public static function parse($data)
    {
        $result = null;
        if (isset($data['entity_type']) && isset($data['name'])) {
            if (1 == $data['entity_type']) { // label
                $result = $data['name'];
            }
        }
        return $result;
    }
}

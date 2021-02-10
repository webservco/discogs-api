<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class Format implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{

    public static function parse($data)
    {
        $result = null;
        if (isset($data['qty']) && $data['qty'] > 1) {
            $result .= \sprintf('%s x ', $data['qty']);
        }
        if (isset($data['name'])) {
            $result .= $data['name'];
        }
        if (isset($data['descriptions'])) {
            $result .= ', ' . \WebServCo\DiscogsApi\Parsers\Collection\FormatDescriptions::parse($data['descriptions']);
        }
        if (isset($data['text'])) {
            $result .= \sprintf(', %s', $data['text']);
        }
        return $result;
    }
}

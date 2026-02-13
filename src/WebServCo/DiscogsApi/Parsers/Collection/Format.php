<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

use WebServCo\DiscogsApi\Interfaces\ParserInterface;

use function sprintf;

final class Format implements ParserInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        if (isset($data['qty']) && $data['qty'] > 1) {
            $result .= sprintf('%s x ', $data['qty']);
        }
        if (isset($data['name'])) {
            $result .= $data['name'];
        }
        if (isset($data['descriptions'])) {
            $result .= ', ' . FormatDescriptions::parse($data['descriptions']);
        }
        if (isset($data['text'])) {
            $result .= sprintf(', %s', $data['text']);
        }

        return $result;
    }
}

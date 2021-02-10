<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class CatNos implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{

    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        $catnos = [];
        if (\is_array($data)) {
            foreach ($data as $item) {
                $catnos[] = \WebServCo\DiscogsApi\Parsers\Collection\CatNo::parse($item);
            }
            $result = \implode(', ', $catnos);
        }
        return $result;
    }
}

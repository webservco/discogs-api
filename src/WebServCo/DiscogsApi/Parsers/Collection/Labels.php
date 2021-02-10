<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class Labels implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{

    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        $labels = [];
        if (\is_array($data)) {
            foreach ($data as $item) {
                $labels[] = \WebServCo\DiscogsApi\Parsers\Collection\Label::parse($item);
            }
            $result = \implode(', ', $labels);
        }
        return $result;
    }
}

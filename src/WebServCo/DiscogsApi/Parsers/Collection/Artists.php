<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

use WebServCo\DiscogsApi\Interfaces\ParserInterface;

use function array_key_exists;
use function count;
use function sprintf;

final class Artists implements ParserInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string
    {
        $result = '';
        $items = count($data);
        for ($i = 0; $i < $items; $i++) {
            $result .= !empty($data[$i]['anv'])
                ? $data[$i]['anv']
                : $data[$i]['name'];
            $next = $i + 1;
            if (!array_key_exists($next, $data)) {
                continue;
            }

            switch ($data[$i]['join']) {
                case ',':
                    // special case: no space between artist and join
                    $pre = '';

                    break;
                // eg: ",", "featuring"
                default:
                    // default: space between artist and join
                    $pre = ' ';

                    break;
            }
            $result .= sprintf("%s%s ", $pre, $data[$i]['join']);
        }

        return $result;
    }
}

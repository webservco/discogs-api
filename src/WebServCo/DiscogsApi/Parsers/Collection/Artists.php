<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Parsers\Collection;

final class Artists implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    public static function parse($data)
    {
        $result = null;
        $items = count($data);
        for ($i = 0; $i < $items; $i++) {
            $result .= !empty($data[$i]['anv']) ? $data[$i]['anv'] : $data[$i]['name'];
            $next = $i + 1;
            if (array_key_exists($next, $data)) {
                switch ($data[$i]['join']) {
                    case ',':
                        // special case: no space between artist and join
                        $pre = '';
                        break;
                    default: // eg: ",", "featuring"
                        // default: space between artist and join
                        $pre = ' ';
                        break;
                }
                $result .= sprintf("%s%s ", $pre, $data[$i]['join']);
            }
        }
        return $result;
    }
}

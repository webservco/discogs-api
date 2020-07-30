<?php
namespace WebServCo\DiscogsApi\Parsers\Collection;

final class Artists implements \WebServCo\DiscogsApi\Interfaces\ParserInterface
{
    public static function parse($data)
    {
        $nameUtility = new \WebServCo\DiscogsApi\Utilities\Name();
        $result = null;
        $items = count($data);
        for ($i = 0; $i < $items; $i++) {
            $result .= !empty($data[$i]['anv']) ? $data[$i]['anv'] : $nameUtility->removeNumbering($data[$i]['name']);
            $next = $i + 1;
            if (array_key_exists($next, $data)) {
                $result .= " {$data[$i]['join']} ";
            }
        }
        return $result;
    }
}

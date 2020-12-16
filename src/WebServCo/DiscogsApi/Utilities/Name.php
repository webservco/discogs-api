<?php
namespace WebServCo\DiscogsApi\Utilities;

final class Name
{
    protected $prefixes;

    public function __construct($prefixes = [])
    {
        $this->prefixes = $prefixes ? $prefixes : [];
    }

    public function removeNumbering($data)
    {
        $result = preg_replace('/\([0-9]+\)/', '', (string) $data); // remove numbering
        return trim((string) $result);
    }

    public function removePrefixes($data)
    {
        $patterns = [];
        foreach ($this->prefixes as $item) {
            $patterns[] = sprintf('/^%s /i', $item);
        }

        return preg_replace($patterns, '', $data);
    }
}

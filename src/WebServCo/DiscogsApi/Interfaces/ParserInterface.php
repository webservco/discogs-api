<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Interfaces;

interface ParserInterface
{

    /**
    * @param array<int|string,mixed> $data
    */
    public static function parse(array $data): string;
}

<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Interfaces;

interface ValidatorInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public function validate(array $data): bool;
}

<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Validators\Collection;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Artist implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public function validate(array $data): bool
    {
        if (!\is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }

        foreach (['join', 'name', 'anv', 'tracks', 'role', 'resource_url', 'id'] as $item) {
            if (!\array_key_exists($item, $data)) {
                throw new ValidatorException(\sprintf('Missing required item: %s', $item));
            }
        }
        return true;
    }
}

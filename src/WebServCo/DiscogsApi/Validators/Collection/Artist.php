<?php
namespace WebServCo\DiscogsApi\Validators\Collection;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Artist implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{
    public function validate($data)
    {
        if (!is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }

        foreach (['join', 'name', 'anv', 'tracks', 'role', 'resource_url', 'id'] as $item) {
            if (!isset($data[$item])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        return true;
    }
}

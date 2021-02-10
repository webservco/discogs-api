<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Validators\CollectionFolders;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Item implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{

    /**
    * @param array<int|string,mixed> $data
    */
    public function validate(array $data)
    {
        if (!\is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }

        foreach (['name'] as $item) {
            if (empty($data[$item])) {
                throw new ValidatorException(\sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['id', 'count'] as $item) {
            if (!\array_key_exists($item, $data)) {
                throw new ValidatorException(\sprintf('Missing required item: %s', $item));
            }
        }

        return true;
    }
}

<?php
namespace WebServCo\DiscogsApi\Validators\CollectionFolders;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Item implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{
    public function validate($data)
    {
        if (!is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }

        foreach (['name'] as $item) {
            if (empty($data[$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['id', 'count'] as $item) {
            if (!isset($data[$item])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }

        return true;
    }
}

<?php
namespace WebServCo\DiscogsApi\Validators\Collection;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Note implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{
    public function validate($data)
    {
        if (!is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }

        foreach (['field_id', 'value'] as $item) {
            if (!array_key_exists($item, $data)) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        return true;
    }
}

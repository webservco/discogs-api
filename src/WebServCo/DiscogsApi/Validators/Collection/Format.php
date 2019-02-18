<?php
namespace WebServCo\DiscogsApi\Validators\Collection;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Format implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{
    public function validate($data)
    {
        if (!is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }

        foreach (['name', 'qty'] as $item) {
            if (!isset($data[$item])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        return true;
    }
}

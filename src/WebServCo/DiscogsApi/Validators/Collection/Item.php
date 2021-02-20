<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Validators\Collection;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Item implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{

    /**
    * @param array<int|string,mixed> $data
    */
    public function validate(array $data): bool
    {
        if (!\is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }

        foreach (['instance_id', 'basic_information', 'date_added', 'id'] as $item) {
            if (empty($data[$item])) {
                throw new ValidatorException(\sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['rating', 'folder_id'] as $item) {
            if (!\array_key_exists($item, $data)) {
                throw new ValidatorException(\sprintf('Missing required item: %s', $item));
            }
        }

        foreach (['labels', 'year', 'artists', 'thumb', 'title', 'formats', 'master_id'] as $item) {
            if (!\array_key_exists($item, $data['basic_information'])) {
                throw new ValidatorException(\sprintf('Missing required item: %s', $item));
            }
        }

        foreach (['labels', 'artists', 'formats'] as $item) {
            if (!\is_array($data['basic_information'][$item])) {
                throw new ValidatorException(\sprintf('Invalid data format: %s', $item));
            }
        }

        return true;
    }
}

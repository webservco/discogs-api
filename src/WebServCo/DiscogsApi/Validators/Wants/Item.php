<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Validators\Wants;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;
use WebServCo\DiscogsApi\Interfaces\ValidatorInterface;

use function array_key_exists;
use function is_array;
use function sprintf;

final class Item implements ValidatorInterface
{
    /**
    * @param array<int|string,mixed> $data
    */
    public function validate(array $data): bool
    {
        if (!is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }
        foreach (['id', 'resource_url', 'date_added', 'basic_information'] as $item) {
            if (empty($data[$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['rating', 'notes'] as $item) {
            if (!array_key_exists($item, $data)) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach (['id', 'title', 'formats', 'labels', 'artists'] as $item) {
            if (empty($data['basic_information'][$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (
            [
            'resource_url', 'year', 'thumb', 'cover_image', 'genres', 'styles'] as $item
        ) {
            // Can be missing: 'master_id', 'master_url'
            if (!array_key_exists($item, $data['basic_information'])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
         // NOTE: Individual items structure is the same as Collection, use those validators.
        foreach (['formats', 'labels', 'artists',] as $item) {
            if (!is_array($data['basic_information'][$item])) {
                throw new ValidatorException(sprintf('Invalid data format: %s', $item));
            }
        }

        return true;
    }
}

<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Validators\Lists;

use WebServCo\DiscogsApi\Exceptions\ValidatorException;

final class Item implements \WebServCo\DiscogsApi\Interfaces\ValidatorInterface
{
    public function validate($data)
    {
        if (!is_array($data)) {
            throw new ValidatorException('Invalid data type');
        }
        foreach ([
            'id',
            'user',
            'name',
            'description',
            'public',
            'date_added',
            'date_changed',
            'uri',
            'resource_url',
            'image_url'
            ] as $item) {
            if (!array_key_exists($item, $data)) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach ([
            'id',
            'name',
            'date_added',
            'date_changed',
            'uri',
            'resource_url'
            ] as $item) {
            if (empty($data[$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['id', 'avatar_url', 'username', 'resource_url'] as $item) {
            if (!array_key_exists($item, $data['user'])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach (['id', 'username', 'resource_url'] as $item) {
            if (empty($data['user'][$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }

        return true;
    }
}

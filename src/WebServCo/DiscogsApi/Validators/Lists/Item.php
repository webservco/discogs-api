<?php
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
            if (!isset($data[$item])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach ([
            'id',
            'name',
            'date_added',
            'date_changed',
            'uri',
            'resource_url',
            'image_url'
            ] as $item) {
            if (empty($data[$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['id', 'avatar_url', 'username', 'resource_url'] as $item) {
            if (!isset($data['user'][$item])) {
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

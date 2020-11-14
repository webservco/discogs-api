<?php
namespace WebServCo\DiscogsApi\Validators\Inventory;

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
            'resource_url',
            'uri',
            'status',
            'condition',
            'sleeve_condition',
            'comments',
            'ships_from',
            'posted',
            'allow_offers',
            'audio',
            'price',
            'original_price',
            'shipping_price',
            'original_shipping_price',
            'seller',
            'release',
            'in_cart',
            'weight',
            'estimated_weight',
            'format_quantity',
            'external_id',
            'location',
            ] as $item) {
            if (!array_key_exists($item, $data)) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach ([
            'id',
            'resource_url',
            'uri',
            'status',
            'condition',
            'sleeve_condition',
            'ships_from',
            'posted',
            'price',
            'original_price',
            'seller',
            'release',
            // 'format_quantity', this can be empty (01.11.2020 SchusterBach)
            ] as $item) {
            if (empty($data[$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['value', 'currency'] as $item) {
            if (empty($data['price'][$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['curr_abbr', 'curr_id', 'formatted', 'value'] as $item) {
            if (empty($data['original_price'][$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        if (!empty($data['shipping_price'])) {
            foreach (['value', 'currency'] as $item) {
                if (empty($data['shipping_price'][$item])) {
                    throw new ValidatorException(sprintf('Empty required item: %s', $item));
                }
            }
        }
        if (!empty($data['original_shipping_price'])) {
            foreach (['curr_abbr', 'curr_id', 'formatted', 'value'] as $item) {
                if (empty($data['original_shipping_price'][$item])) {
                    throw new ValidatorException(sprintf('Empty required item: %s', $item));
                }
            }
        }
        foreach ([
            'avatar_url',
            'html_url',
            'id',
            'uid',
            'stats',
            'url',
            'username',
            'min_order_total',
            'payment',
            'shipping',
            'resource_url',
            ] as $item) {
            if (!array_key_exists($item, $data['seller'])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach (['id', 'username'] as $item) {
            if (empty($data['seller'][$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach (['rating', 'stars', 'total'] as $item) {
            if (!array_key_exists($item, $data['seller']['stats'])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach ([
            'thumbnail',
            'description',
            'images',
            'artist',
            'format',
            'resource_url',
            'title',
            'year',
            'id',
            'catalog_number',
            'stats',
            ] as $item) {
            if (!array_key_exists($item, $data['release'])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach ([
            'artist',
            'format',
            'resource_url',
            'title',
            'id',
            'catalog_number',
            'stats',
            ] as $item) {
            if (empty($data['release'][$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach ([
            'community',
            'user',
            ] as $item) {
            if (empty($data['release']['stats'][$item])) {
                throw new ValidatorException(sprintf('Empty required item: %s', $item));
            }
        }
        foreach ([
            'in_wantlist',
            'in_collection',
            ] as $item) {
            if (!array_key_exists($item, $data['release']['stats']['community'])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        foreach ([
            'in_wantlist',
            'in_collection',
            ] as $item) {
            if (!array_key_exists($item, $data['release']['stats']['user'])) {
                throw new ValidatorException(sprintf('Missing required item: %s', $item));
            }
        }
        return true;
    }
}

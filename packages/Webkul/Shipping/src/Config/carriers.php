<?php

return [
    'flatrate' => [
        'code'             => 'flatrate',
        'title'            => 'Flat Rate',
        'description'      => 'Flat Rate Shipping',
        'active'           => true,
        'is_calculate_tax' => false,
        'default_rate'     => '10',
        'type'             => 'per_unit',
        'class'            => 'Webkul\Shipping\Carriers\FlatRate',
    ],

    'free'     => [
        'code'             => 'free',
        'title'            => 'Free Shipping',
        'description'      => 'Free Shipping',
        'active'           => true,
        'is_calculate_tax' => false,
        'default_rate'     => '0',
        'class'            => 'Webkul\Shipping\Carriers\Free',
    ],
    'express' => [
        'code'             => 'express',
        'title'            => 'Express',
        'description'      => '1 sagadyn dowamynda eltip berilyar',
        'active'           => true,
        'is_calculate_tax' => false,
        'default_rate'     => '20',
        'class'            => 'Webkul\Shipping\Carriers\Express',
    ]
];
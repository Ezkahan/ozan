<?php

return [
    'irden' => [
        'code'             => 'irden',
        'title'            => 'Irden 09:00 - 12:00',
        'description'      => 'Irden eltip berme 09:00 - 12:00. 100 manatdan yokary sowdada eltip berme mugt',
        'active'           => true,
        'start_time'       => '09:00',
        'end_time'         => '13:00',
        'default_rate'     => '20',
        'class'            => 'Webkul\Shipping\Carriers\Irden',
    ],
    'obetda' => [
        'code'             => 'obetda',
        'title'            => 'Öýlän 12:00 - 16:00',
        'description'      => 'Öýlän eltip berme 12:00 - 16:00 100 manatdan yokary sowdada eltip berme mugt',
        'active'           => true,
        'start_time'       => '13:00',
        'end_time'         => '18:00',
        'default_rate'     => '20',
        'class'            => 'Webkul\Shipping\Carriers\Obetda',
    ],
    'agsam' => [
        'code'             => 'agsam',
        'title'            => 'Agşam 16:00 - 20:00',
        'description'      => 'Agşam eltip berme 16:00 - 20:00 100 manatdan yokary sowdada eltip berme mugt',
        'active'           => true,
        'start_time'       => '18:00',
        'end_time'         => '23:00',
        'default_rate'     => '20',
        'class'            => 'Webkul\Shipping\Carriers\Agsham',
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
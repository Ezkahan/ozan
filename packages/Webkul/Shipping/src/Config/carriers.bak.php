<?php

return [
    'ashgabat' => [
        'irden' => [
            'code'             => 'irden',
            'title'            => 'Irden 10:00 - 12:00',
            'description'      => 'Irden eltip berme 09:00 - 12:00. 100 manatdan yokary sowdada eltip berme mugt',
            'active'           => true,
            'start_time'       => '10:00',
            'end_time'         => '12:00',
            'default_rate'     => '20',
            'class'            => 'Webkul\Shipping\Carriers\Irden',
        ],
        'irden2' => [
            'code'             => 'irden2',
            'title'            => 'Irden 10:00 - 12:00',
            'description'      => 'Irden eltip berme 09:00 - 12:00. 100 manatdan yokary sowdada eltip berme mugt',
            'active'           => true,
            'start_time'       => '10:00',
            'end_time'         => '12:00',
            'default_rate'     => '20',
            'class'            => 'Webkul\Shipping\Carriers\Irden2',
        ],
        'obetda' => [
            'code'             => 'obetda',
            'title'            => 'Öýlän 12:00 - 15:00',
            'description'      => 'Öýlän eltip berme 12:00 - 16:00 100 manatdan yokary sowdada eltip berme mugt',
            'active'           => true,
            'start_time'       => '12:00',
            'end_time'         => '15:00',
            'default_rate'     => '20',
            'class'            => 'Webkul\Shipping\Carriers\Obetda',
        ],
        'ikindi' => [
            'code'             => 'ikindi',
            'title'            => 'Ikindi 15:00 - 18:00',
            'description'      => 'Ikindi wagty eltip berme 15:00 - 18:00 100 manatdan yokary sowdada eltip berme mugt',
            'active'           => true,
            'start_time'       => '15:00',
            'end_time'         => '18:30',
            'default_rate'     => '10',
            'class'            => 'Webkul\Shipping\Carriers\Ikindi',
        ],
        'agsam' => [
            'code'             => 'agsam',
            'title'            => 'Agşam 16:00 - 20:00',
            'description'      => 'Agşam eltip berme 16:00 - 20:00 100 manatdan yokary sowdada eltip berme mugt',
            'active'           => true,
            'start_time'       => '18:30',
            'end_time'         => '22:00',
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
        ],
        'takeaway' => [
            'code'             => 'takeaway',
            'title'            => 'Özum baryp aljak',
            'description'      => '',
            'active'           => true,
            'class'            => 'Webkul\Shipping\Carriers\Takeaway',
        ]
    ],
    'awaza' => [
        'takeaway' => [
            'code'             => 'takeaway',
            'title'            => 'Özum baryp aljak',
            'description'      => '',
            'active'           => true,
            'class'            => 'Webkul\Shipping\Carriers\Awaza\Takeaway',
        ]

    ]
];

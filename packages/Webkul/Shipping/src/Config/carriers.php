<?php

return [
    'irden' => [
        'code' => 'irden',
        'title' => '09:00 - 12:00',
        'description' => 'Irden eltip berme 09:00 - 12:00. 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '09:00',
        'end_time' => '12:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Irden',
    ],
    // 'irden2' => [
    //     'code'             => 'irden2',
    //     'title'            => 'Irden 10:00 - 12:00',
    //     'description'      => 'Irden eltip berme 09:00 - 12:00. 100 manatdan yokary sowdada eltip berme mugt',
    //     'active'           => true,
    //     'start_time'       => '10:00',
    //     'end_time'         => '12:00',
    //     'default_rate'     => '20',
    //     'class'            => 'Webkul\Shipping\Carriers\Irden2',
    // ],
    'obetda' => [
        'code' => 'obetda',
        'title' => '12:00 - 14:00',
        'description' => 'Öýlän eltip berme 12:00 - 14:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '12:00',
        'end_time' => '14:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Obetda',
    ],
    'ikindi' => [
        'code' => 'ikindi',
        'title' => '14:00 - 16:00',
        'description' => 'Ikindi wagty eltip berme 14:00 - 16:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '14:00',
        'end_time' => '16:00',
        'default_rate' => '10',
        'class' => 'Webkul\Shipping\Carriers\Ikindi',
    ],
    'agsam' => [
        'code' => 'agsam',
        'title' => '16:00 - 18:00',
        'description' => 'Agşam eltip berme 16:00 - 18:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '16:00',
        'end_time' => '18:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Agsham',
    ],
    'agsam2' => [
        'code' => 'agsam2',
        'title' => '18:00 - 20:00',
        'description' => 'Agşam eltip berme 18:00 - 20:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '18:00',
        'end_time' => '20:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Agsham2',
    ],
    'gije' => [
        'code' => 'gije',
        'title' => '20:00 - 22:30',
        'description' => 'Gije eltip berme 20:00 - 22:30 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '20:00',
        'end_time' => '22:30',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Gije',
    ],
    'gije2' => [
        'code' => 'gije2',
        'title' => '22:30 - 00:00',
        'description' => 'Gije eltip berme 22:30 - 00:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '22:30',
        'end_time' => '00:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Gije2',
    ],

    'free' => [
        'code' => 'free',
        'title' => 'Free Shipping',
        'description' => 'Free Shipping',
        'active' => true,
        'is_calculate_tax' => false,
        'default_rate' => '0',
        'class' => 'Webkul\Shipping\Carriers\Free',
    ],
    'express' => [
        'code' => 'express',
        'title' => 'Express',
        'description' => '1 sagadyn dowamynda eltip berilyar',
        'active' => true,
        'is_calculate_tax' => false,
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Express',
    ],
    'takeaway' => [
        'code' => 'takeaway',
        'title' => 'Özum baryp aljak',
        'description' => '',
        'active' => true,
        'class' => 'Webkul\Shipping\Carriers\Takeaway',
    ],


    //Awaza

    'awaza_irden' => [
        'code' => 'awaza.irden',
        'title' => '09:00 - 12:00',
        'description' => 'Irden eltip berme 09:00 - 12:00. 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '09:00',
        'end_time' => '12:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\IrdenAwaza',
    ],
    // 'irden2' => [
    //     'code'             => 'irden2',
    //     'title'            => 'Irden 10:00 - 12:00',
    //     'description'      => 'Irden eltip berme 09:00 - 12:00. 100 manatdan yokary sowdada eltip berme mugt',
    //     'active'           => true,
    //     'start_time'       => '10:00',
    //     'end_time'         => '12:00',
    //     'default_rate'     => '20',
    //     'class'            => 'Webkul\Shipping\Carriers\Awaza\Irden2',
    // ],
    'awaza_obetda' => [
        'code' => 'awaza.obetda',
        'title' => '12:00 - 14:00',
        'description' => 'Öýlän eltip berme 12:00 - 14:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '12:00',
        'end_time' => '14:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\ObetdaAwaza',
    ],
    'awaza_ikindi' => [
        'code' => 'awaza.ikindi',
        'title' => '14:00 - 16:00',
        'description' => 'Ikindi wagty eltip berme 14:00 - 16:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '14:00',
        'end_time' => '16:00',
        'default_rate' => '10',
        'class' => 'Webkul\Shipping\Carriers\IkindiAwaza',
    ],
    'awaza_agsam' => [
        'code' => 'awaza.agsam',
        'title' => '16:00 - 18:00',
        'description' => 'Agşam eltip berme 16:00 - 18:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '16:00',
        'end_time' => '18:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\AgshamAwaza',
    ],
    'awaza_agsam2' => [
        'code' => 'awaza.agsam2',
        'title' => '18:00 - 20:00',
        'description' => 'Agşam eltip berme 18:00 - 20:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '18:00',
        'end_time' => '20:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Agsham2Awaza',
    ],
    'awaza_gije' => [
        'code' => 'awaza.gije',
        'title' => '20:00 - 22:30',
        'description' => 'Gije eltip berme 20:00 - 22:30 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '20:00',
        'end_time' => '22:30',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\GijeAwaza',
    ],
    'awaza_gije2' => [
        'code' => 'awaza.gije2',
        'title' => '22:30 - 00:00',
        'description' => 'Gije eltip berme 22:30 - 00:00 100 manatdan ýokary söwdada eltip berme mugt',
        'active' => true,
        'start_time' => '22:30',
        'end_time' => '00:00',
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\Gije2Awaza',
    ],

    'awaza_free' => [
        'code' => 'awaza.free',
        'title' => 'Free Shipping',
        'description' => 'Free Shipping',
        'active' => true,
        'is_calculate_tax' => false,
        'default_rate' => '0',
        'class' => 'Webkul\Shipping\Carriers\FreeAwaza',
    ],
    'awaza_express' => [
        'code' => 'awaza.express',
        'title' => 'Express',
        'description' => '1 sagadyn dowamynda eltip berilyar',
        'active' => true,
        'is_calculate_tax' => false,
        'default_rate' => '20',
        'class' => 'Webkul\Shipping\Carriers\ExpressAwaza',
    ],
    'awaza_takeaway' => [
        'code' => 'awaza.takeaway',
        'title' => 'Özum baryp aljak(Awaza)',
        'description' => '',
        'active' => true,
        'class' => 'Webkul\Shipping\Carriers\TakeawayAwaza',
    ],

];

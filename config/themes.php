<?php

return [
    'default' => 'velocity_ozan',

    'themes' => [
        'default' => [
            'views_path' => 'resources/themes/default/views',
            'assets_path' => 'public/themes/default/assets',
            'name' => 'Default'
        ],

         'velocity_ozan' => [
             'views_path' => 'resources/themes/velocity_ozan/views',
             'assets_path' => 'public/themes/velocity_ozan/assets',
             'name' => 'OZAN-V',
             'parent' => 'default'
         ],
        'ozan' => [
            'views_path' => 'resources/themes/ozan/views',
            'assets_path' => 'public/themes/ozan/assets',
            'name' => 'Ozan',
            'parent' => 'default'
        ],
        'velocity' => [
            'views_path' => 'resources/themes/velocity/views',
            'assets_path' => 'public/themes/velocity/assets',
            'name' => 'Velocity',
            'parent' => 'default'
        ],
    ],

    'admin-default' => 'default',

    'admin-themes' => [
        'default' => [
            'views_path' => 'resources/admin-themes/default/views',
            'assets_path' => 'public/admin-themes/default/assets',
            'name' => 'Default'
        ]
    ]
];

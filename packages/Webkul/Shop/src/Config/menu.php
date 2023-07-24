<?php

return [
    [
        'key'   => 'account',
        'name'  => 'velocity::app.layouts.my-account',
        'route' =>'customer.profile.index',
        'sort'  => 1,
    ], [
        'key'   => 'account.profile',
        'name'  => 'velocity::app.layouts.profile',
        'route' =>'customer.profile.index',
        'sort'  => 1,
    ], [
        'key'   => 'account.address',
        'name'  => 'velocity::app.layouts.address',
        'route' =>'customer.address.index',
        'sort'  => 2,
    ], [
        'key'   => 'account.reviews',
        'name'  => 'velocity::app.layouts.reviews',
        'route' =>'customer.reviews.index',
        'sort'  => 3,
    ], [
        'key'   => 'account.wishlist',
        'name'  => 'velocity::app.layouts.wishlist',
        'route' =>'customer.wishlist.index',
        'sort'  => 4,
    ], [
        'key'   => 'account.compare',
        'name'  => 'velocity::app.customer.compare.text',
        'route' =>'velocity.customer.product.compare',
        'sort'  => 5,
    ], [
        'key'   => 'account.orders',
        'name'  => 'velocity::app.layouts.orders',
        'route' =>'customer.orders.index',
        'sort'  => 6,
    ],
];

?>
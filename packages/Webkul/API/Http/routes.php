<?php


Route::group(['prefix' => 'api', 'middleware' => 'version'], function ($router) {
    Route::post('/akhasap_sync', [Webkul\Admin\Http\Controllers\AkhasapController::class, 'sync']);


    Route::group(['namespace' => 'Webkul\API\Http\Controllers\Shop', 'middleware' => ['locale', 'theme', 'currency']], function ($router) {
        //Currency and Locale switcher
        Route::get('switch-currency', 'CoreController@switchCurrency');

        Route::get('switch-locale', 'CoreController@switchLocale');

        //Category routes
        Route::get('categories', 'ResourceController@getCategories')->defaults('_config', [
            'repository' => 'Webkul\Category\Repositories\CategoryRepository',
            'resource' => 'Webkul\API\Http\Resources\Catalog\Category',
        ]);

        Route::get('descendant-categories', 'CategoryController@index')->middleware('cacheResponse:30');

        Route::get('categories/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Category\Repositories\CategoryRepository',
                'resource' => 'Webkul\API\Http\Resources\Catalog\Category',
            ])
            ->middleware('cacheResponse:36000');

        Route::get('category/filters', 'CategoryController@getFilters');

        //Attribute routes
        Route::get('attributes', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Attribute\Repositories\AttributeRepository',
                'resource' => 'Webkul\API\Http\Resources\Catalog\Attribute',
            ])
            ->middleware('cacheResponse:36000');

        Route::get('attributes/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Attribute\Repositories\AttributeRepository',
                'resource' => 'Webkul\API\Http\Resources\Catalog\Attribute',
            ])
            ->middleware('cacheResponse:36000');

        //AttributeFamily routes
        Route::get('families', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Attribute\Repositories\AttributeFamilyRepository',
                'resource' => 'Webkul\API\Http\Resources\Catalog\AttributeFamily',
            ])
            ->middleware('cacheResponse:36000');

        Route::get('families/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Attribute\Repositories\AttributeFamilyRepository',
                'resource' => 'Webkul\API\Http\Resources\Catalog\AttributeFamily',
            ])
            ->middleware('cacheResponse:36000');

        //Product routes
        Route::get('products', 'ProductController@index');

        Route::get('products/aksia', 'ProductController@aksia')->middleware('cacheResponse:1800');

        Route::get('products/{id}', 'ProductController@get')->middleware('cacheResponse:1800');

        Route::get('product-additional-information/{id}', 'ProductController@additionalInformation')->middleware('cacheResponse:1800');

        Route::get('product-configurable-config/{id}', 'ProductController@configurableConfig')->middleware('cacheResponse:1800');

        //Product Review routes
        Route::get('reviews', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Product\Repositories\ProductReviewRepository',
                'resource' => 'Webkul\API\Http\Resources\Catalog\ProductReview',
            ])
            ->middleware('cacheResponse:1800');

        Route::get('reviews/{id}', 'ResourceController@get')->defaults('_config', [
            'repository' => 'Webkul\Product\Repositories\ProductReviewRepository',
            'resource' => 'Webkul\API\Http\Resources\Catalog\ProductReview',
        ]);

        Route::post('reviews/{id}/create', 'ReviewController@store');

        Route::delete('reviews/{id}', 'ResourceController@destroy')->defaults('_config', [
            'repository' => 'Webkul\Product\Repositories\ProductReviewRepository',
            'resource' => 'Webkul\API\Http\Resources\Catalog\ProductReview',
            'authorization_required' => true,
        ]);

        Route::get('attribute/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Attribute\Repositories\AttributeRepository',
                'resource' => 'Webkul\API\Http\Resources\Catalog\Attribute',
            ])
            ->middleware('cacheResponse:1800');
        //Channel routes
        Route::get('channels', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\ChannelRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Channel',
            ])
            ->middleware('cacheResponse:1800');

        Route::get('channels/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\ChannelRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Channel',
            ])
            ->middleware('cacheResponse:1800');

        //Locale routes
        Route::get('locales', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\LocaleRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Locale',
            ])
            ->middleware('cacheResponse:36000');

        Route::get('locales/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\LocaleRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Locale',
            ])
            ->middleware('cacheResponse:36000');

        //Country routes
        Route::get('countries', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\CountryRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Country',
            ])
            ->middleware('cacheResponse:36000');

        Route::get('countries/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\CountryRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Country',
            ])
            ->middleware('cacheResponse:36000');

        Route::get('country-states', 'CoreController@getCountryStateGroup')->middleware('cacheResponse:91800');

        //Slider routes
        Route::get('sliders', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\SliderRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Slider',
            ])
            ->middleware('cacheResponse:3600');

        Route::get('sliders/{id}', 'ResourceController@get')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\SliderRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Slider',
            ])
            ->middleware('cacheResponse:3600');

        //Modal banner routes
        Route::get('banners', 'BannerController@index')->middleware('cacheResponse:1800');

        //Inventories
        Route::get('inventories', 'InventoryController@index');

        //Currency routes
        Route::get('currencies', 'ResourceController@index')
            ->defaults('_config', [
                'repository' => 'Webkul\Core\Repositories\CurrencyRepository',
                'resource' => 'Webkul\API\Http\Resources\Core\Currency',
            ])
            ->middleware('cacheResponse:36000');

        Route::get('currencies/{id}', 'ResourceController@get')->defaults('_config', [
            'repository' => 'Webkul\Core\Repositories\CurrencyRepository',
            'resource' => 'Webkul\API\Http\Resources\Core\Currency',
        ]);

        Route::get('config', 'CoreController@getConfig');

        //Customer routes
        Route::post('customer/login', 'SessionController@create');

        Route::post('customer/forgot-password', 'ForgotPasswordController@store');

        Route::get('customer/logout', 'SessionController@destroy');

        Route::get('customer/get', 'SessionController@get');

        Route::put('customer/profile', 'SessionController@update');

        Route::post('customer/register', 'SMSAuthenticationController@create');
        Route::post('customer/verify_phone', 'SMSAuthenticationController@verifyPhone'); //send phone, code
        Route::post('customer/resend_code', 'SMSAuthenticationController@resendVerificationSMS'); // send phone

        Route::get('customers/{id}', 'CustomerController@get')->defaults('_config', [
            'repository' => 'Webkul\Customer\Repositories\CustomerRepository',
            'resource' => 'Webkul\API\Http\Resources\Customer\Customer',
            'authorization_required' => true,
        ]);

        //Customer Address routes
        Route::get('addresses', 'AddressController@get')->defaults('_config', [
            'authorization_required' => true,
        ]);

        Route::get('addresses/{id}', 'ResourceController@get')->defaults('_config', [
            'repository' => 'Webkul\Customer\Repositories\CustomerAddressRepository',
            'resource' => 'Webkul\API\Http\Resources\Customer\CustomerAddress',
            'authorization_required' => true,
        ]);

        Route::delete('addresses/{id}', 'ResourceController@destroy')->defaults('_config', [
            'repository' => 'Webkul\Customer\Repositories\CustomerAddressRepository',
            'resource' => 'Webkul\API\Http\Resources\Customer\CustomerAddress',
            'authorization_required' => true,
        ]);

        Route::put('addresses/{id}', 'AddressController@update')->defaults('_config', [
            'authorization_required' => true,
        ]);

        Route::post('addresses/create', 'AddressController@store')->defaults('_config', [
            'authorization_required' => true,
        ]);

        //Order routes
        Route::get('orders', 'OrderController@index');
        Route::get('orders/{id}', 'OrderController@get');
        Route::post('orders/{id}/cancel', 'OrderController@cancel');

        //Invoice routes
        Route::get('invoices', 'InvoiceController@index')->defaults('_config', [
            'repository' => 'Webkul\Sales\Repositories\InvoiceRepository',
            'resource' => 'Webkul\API\Http\Resources\Sales\Invoice',
            'authorization_required' => true,
        ]);

        Route::get('invoices/{id}', 'InvoiceController@get')->defaults('_config', [
            'repository' => 'Webkul\Sales\Repositories\InvoiceRepository',
            'resource' => 'Webkul\API\Http\Resources\Sales\Invoice',
            'authorization_required' => true,
        ]);

        //Invoice routes
        Route::get('shipments', 'ResourceController@index')->defaults('_config', [
            'repository' => 'Webkul\Sales\Repositories\ShipmentRepository',
            'resource' => 'Webkul\API\Http\Resources\Sales\Shipment',
            'authorization_required' => true,
        ]);

        Route::get('shipments/{id}', 'ResourceController@get')->defaults('_config', [
            'repository' => 'Webkul\Sales\Repositories\ShipmentRepository',
            'resource' => 'Webkul\API\Http\Resources\Sales\Shipment',
            'authorization_required' => true,
        ]);

        //Wishlist routes
        Route::get('wishlist', 'ResourceController@index')->defaults('_config', [
            'repository' => 'Webkul\Customer\Repositories\WishlistRepository',
            'resource' => 'Webkul\API\Http\Resources\Customer\Wishlist',
            'authorization_required' => true,
        ]);

        Route::delete('wishlist/{id}', 'ResourceController@destroy')->defaults('_config', [
            'repository' => 'Webkul\Customer\Repositories\WishlistRepository',
            'resource' => 'Webkul\API\Http\Resources\Customer\Wishlist',
            'authorization_required' => true,
        ]);

        Route::get('move-to-cart/{id}', 'WishlistController@moveToCart');

        Route::get('wishlist/add/{id}', 'WishlistController@create');

        Route::group(['prefix' => 'akhasap'], function ($router) {
            Route::post('products/store', 'AkHasapController@store');
            Route::get('products/fixdb/{page}', 'AkHasapController@fixdb');
            Route::post('categories/store', 'AkHasapController@storeCategories');
            //Route::put('products/update',)
        });

        //Checkout routes
        Route::group(['prefix' => 'checkout'], function ($router) {
            Route::post('cart/add/{id}', 'CartController@store');

            Route::get('cart', 'CartController@get');

            Route::get('cart/empty', 'CartController@destroy');

            Route::put('cart/update', 'CartController@update');

            Route::get('cart/remove-item/{id}', 'CartController@destroyItem');

            Route::post('cart/coupon', 'CartController@applyCoupon');

            Route::delete('cart/coupon', 'CartController@removeCoupon');

            Route::get('cart/move-to-wishlist/{id}', 'CartController@moveToWishlist');

            Route::post('save-address', 'CheckoutController@saveAddress');

            Route::post('save-shipping', 'CheckoutController@saveShipping');

            Route::post('save-payment', 'CheckoutController@savePayment');

            Route::post('check-minimum-order', 'CheckoutController@checkMinimumOrder');

            Route::post('save-order', 'CheckoutController@saveOrder');

            Route::get('methods', 'CheckoutController@method');
            Route::post('checkout', 'CheckoutController@checkout');
        });
    });
});

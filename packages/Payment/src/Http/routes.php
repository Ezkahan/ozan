<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 7/26/2019
 * Time: 16:49
 */
Route::group(['middleware' => ['web']], function () {
    Route::prefix('card/payment/')->group(function () {
        Route::get('altynasyr/redirect', 'Payment\Http\Controllers\AltynAsyrController@redirect')->name('paymentmethod.altynasyr.redirect');
        Route::get('altynasyr/success', 'Payment\Http\Controllers\AltynAsyrController@success')
            ->name('paymentmethod.altynasyr.success')
            ->middleware('theme');
        Route::get('altynasyr/cancel', 'Payment\Http\Controllers\AltynAsyrController@cancel')->name('paymentmethod.altynasyr.cancel');

        Route::get('tfeb/redirect','Payment\Http\Controllers\TFEBController@redirect')->name('paymentmethod.tfeb.redirect');
        Route::get('tfeb/complete', 'Payment\Http\Controllers\TFEBController@complete')
            ->name('paymentmethod.tfeb.complete')
            ->middleware('theme');
        Route::get('tfeb/cancel', 'Payment\Http\Controllers\TFEBController@cancel')->name('paymentmethod.tfeb.cancel');
    });
});
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Webkul\API\Http\Resources\Checkout\CartShippingRate;
use Webkul\Shipping\Facades\Shipping;

class AwazaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAwaza()
    {
        dd(Shipping::getGroupedAllShippingRates());
        foreach (Shipping::getGroupedAllShippingRates() as $code => $shippingMethod) {
            // if (preg_match("/^awaza/i", $code)) continue;
            $rates[] = [
                'carrier_title' => $shippingMethod['carrier_title'],
                'rates' => CartShippingRate::collection(collect($shippingMethod['rates'])),
            ];
            dd($rates);
        }
        // return $rates;
    }
}

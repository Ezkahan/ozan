<?php

namespace Webkul\Shipping\Carriers;

use Config;
use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Checkout\Facades\Cart;

/**
 * Class Rate.
 *
 */
class Obetda extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code = 'obetda';

    /**
     * Returns rate for flatrate
     *
     * @return CartShippingRate|false
     */
    public function calculate()
    {
        if (! $this->isAvailable()) {
            return false;
        }

        $cart = Cart::getCart();

        $object = new CartShippingRate;

        $object->carrier = 'obetda';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'obetda_obetda';
        $object->method_title = $this->getConfigData('title');
        $object->method_description = $this->getConfigData('description');
        $object->is_calculate_tax = $this->getConfigData('is_calculate_tax');
        $object->price = 0;
        $object->base_price = 0;

            $object->price = core()->convertPrice($this->getConfigData('default_rate'));
            $object->base_price = $this->getConfigData('default_rate');

        return $object;
    }
}
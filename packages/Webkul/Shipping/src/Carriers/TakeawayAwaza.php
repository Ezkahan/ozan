<?php

namespace Webkul\Shipping\Carriers;

use Carbon\Carbon;
use Config;
use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Checkout\Facades\Cart;

/**
 * Class Rate.
 *
 */
class Takeaway extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code = 'awaza.takeaway';


    /**
     * Returns rate for flatrate
     *
     * @return CartShippingRate|false
     */
    public function calculate()
    {
        if (!$this->isAvailable()) {
            return false;
        }

        $cart = Cart::getCart();

        $object = new CartShippingRate;

        $object->carrier = 'awaza.takeaway';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'takeaway';
        $object->method_title = $this->getConfigData('title');
        $object->method_description = $this->getConfigData('description');

        return $object;
    }
}

<?php

namespace Webkul\Shipping\Carriers\Awaza;

use Config;
use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Shipping\Facades\Shipping;

/**
 * Class Rate.
 *
 */
class Free extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'awaza_free';
    /**
     * Returns payment method title
     *
     * @return array
     */
    public function getTitle()
    {
        return $this->getConfigData('title');
    }
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

        $object = new CartShippingRate;

        $object->carrier = 'awaza_free';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'free_free';
        $object->method_title = $this->getConfigData('title');
        $object->method_description = $this->getConfigData('description');
        $object->is_calculate_tax = $this->getConfigData('is_calculate_tax');
        $object->price = 0;
        $object->base_price = 0;

        return $object;
    }
}

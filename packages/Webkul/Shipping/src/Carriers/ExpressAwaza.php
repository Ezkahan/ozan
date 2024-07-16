<?php


namespace Webkul\Shipping\Carriers;


use Webkul\Checkout\Facades\Cart;
use Webkul\Checkout\Models\CartShippingRate;

class Express extends AbstractShipping
{
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
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'awaza.express';

    public function calculate()
    {
        if (!$this->isAvailable()) {
            return false;
        }

        $cart = Cart::getCart();

        $object = new CartShippingRate;

        $object->carrier = 'awaza.express';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'express_express';
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

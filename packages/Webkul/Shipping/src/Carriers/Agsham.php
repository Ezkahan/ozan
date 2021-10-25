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
class Agsham extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code = 'agsam';

    /**
     * Returns payment method title
     *
     * @return array
     */
    public function getTitle()
    {
        $start_time = Carbon::createFromTimeString($this->getConfigData('start_time'));

        $tomorrow = Carbon::now()->gte($start_time) ;

        return  trans($tomorrow ? 'app.tomorrow' : 'app.today').' '
            .$this->getConfigData('title').' '
            .$this->getConfigData('start_time').' - '
            .$this->getConfigData('end_time');
    }
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

        $object->carrier = 'agsam';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'agsam_agsam';
        $object->method_title = $this->getTitle();
        $object->method_description = $this->getConfigData('description');
        $object->is_calculate_tax = false;
        $object->price = 0;
        $object->base_price = 0;

            $object->price = core()->convertPrice($this->getConfigData('default_rate'));
            $object->base_price = $this->getConfigData('default_rate');

        return $object;
    }
}
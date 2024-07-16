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
class IrdenAwaza extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code = 'awaza.irden';


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

        $start_time = Carbon::createFromTimeString($this->getConfigData('start_time'));

        $tomorrow = Carbon::now()->gte($start_time);

        $title =   trans($tomorrow ? 'app.tomorrow' : 'app.today') . ' '
            . $this->getConfigData('title') . ' '
            . $this->getConfigData('start_time') . ' - '
            . $this->getConfigData('end_time');

        $object = new CartShippingRate;

        $object->carrier = 'awaza.irden';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'irden_irden';
        $object->method_title = $title;
        $object->method_description = $this->getConfigData('description');
        $object->is_calculate_tax = false;
        $object->price = 0;
        $object->base_price = 0;

        $object->price = core()->convertPrice($this->getConfigData('default_rate'));
        $object->base_price = $this->getConfigData('default_rate');

        return $object;
    }
}

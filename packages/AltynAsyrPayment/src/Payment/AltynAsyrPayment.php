<?php

namespace AltynAsyrPayment\Payment;

use Webkul\Payment\Payment\Payment;

class AltynAsyrPayment extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'altynasyrpayment';

    public function getRedirectUrl()
    {
        
    }
}
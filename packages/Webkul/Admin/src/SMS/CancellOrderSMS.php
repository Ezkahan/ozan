<?php


namespace Webkul\Admin\SMS;


class CancellOrderSMS extends SMS
{

    public function __construct($order)
    {
        $this->recipient = '993'.$order->customer_email;
        $this->id = 'order_'.$order->id;
//        $this->source = url();
        $this->text = 'Sizin ozan.com.tm  #'.$order->id.' belgili sargydyňyz ýatyryldy';//trans('shop::app.sms.verification',$data);
    }

    function tags(){
        return [
            date('Y'),
            "order",
            'cancel'
        ];
    }
}
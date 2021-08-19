<?php


namespace Webkul\Admin\SMS;


use Illuminate\Support\Facades\Log;

class AcceptOrderSMS extends SMS
{

    public function __construct($order)
    {
        $this->recipient = '993'.$order['customer_email'];
        $this->id = 'order_'.$order['id'];
        $this->text = 'Sizin ozan.com.tm  #'.$order['id'].' belgili sargydyňyz kabul edildi';//trans('shop::app.sms.verification',$data);

        Log::info('AcceptOrderSMS const');
        Log::info('recipient: '.$this->recipient);
        Log::info('order phone: '.$order['customer_email']);
        Log::info('order_id'.$this->id );
        Log::info($order);

    }

    function tags(){
        return [
            date('Y'),
            "order",
            'accept'
        ];
    }
}
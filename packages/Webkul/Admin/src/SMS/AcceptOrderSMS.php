<?php


namespace Webkul\Admin\SMS;


use Illuminate\Support\Facades\Log;

class AcceptOrderSMS extends SMS
{

    public function __construct($id,$phone)
    {
        $this->recipient = '993'.$phone;
        $this->id = 'order_'.$id;
        $this->text = 'Sizin ozan.com.tm  #'.$id.' belgili sargydyňyz kabul edildi';//trans('shop::app.sms.verification',$data);

        Log::info('AcceptOrderSMS const');
        Log::info($this->recipient);
        Log::info($phone);
    }

    function tags(){
        return [
            date('Y'),
            "order",
            'accept'
        ];
    }
}
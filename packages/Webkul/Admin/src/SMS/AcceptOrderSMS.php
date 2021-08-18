<?php


namespace Webkul\Admin\SMS;


class AcceptOrderSMS extends SMS
{

    public function __construct($id,$phone)
    {
        $this->recipient = '993'.$phone;
        $this->id = 'order_'.$id;
//        $this->source = url();
        $this->text = 'Sizin ozan.com.tm  #'.$id.' belgili sargydyňyz kabul edildi';//trans('shop::app.sms.verification',$data);
    }

    function tags(){
        return [
            date('Y'),
            "order",
            'accept'
        ];
    }
}
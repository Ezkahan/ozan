<?php


namespace Webkul\Admin\SMS;


class AcceptOrder
{
    public $recipient;
    public $recipientType = "recipient";
    public $id;
    public $source = 'ozan.com.tm';
//    public $groupId = 'customer';
    public $shortenUrl = true;
    public $text;
    public $timeout = 3600;

    public function __construct($order)
    {
        $this->recipient = '993'.$order->customer_email;
        $this->id = 'order_'.$order->id;
//        $this->source = url();
        $this->text = 'Sizin ozan.com.tm  #'.$order->id.' belgili sargydyňyz kabul edildi';//trans('shop::app.sms.verification',$data);
    }
}
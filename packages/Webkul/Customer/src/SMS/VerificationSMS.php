<?php


namespace Webkul\Customer\SMS;


class VerificationSMS
{
//{
//"recipient": "79001233333",
//"recipientType": "recipient",
//"id": "string",
//"source": "string",
//"timeout": 3600,
//"shortenUrl": true,
//"text": "Благодарим за регистрацию! Ваш пароль: 7777"
//}

    public $recipient;
    public $recipientType = "customer";
    public $id;
    public $source = 'ozan.com.tm';
//    public $groupId = 'customer';
    public $shortenUrl = true;
    public $text;
    public $timeout = 3600;

    public function __construct($data)
    {
        $this->recipient = '993'.$data['phone'];
        $this->id = 'customer_'.$data['id'];
//        $this->source = url();
        $this->text = 'Sizin ozan.com.tm kodynyz: '.$data['token'];//trans('shop::app.sms.verification',$data);
    }

}
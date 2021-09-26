<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/22/2021
 * Time: 15:40
 */

namespace Payment\CardPayment;

use GuzzleHttp\Client;
use Payment\Http\Resoures\Payment\Order;
use Webkul\Payment\Payment\Payment;

class TFEB extends Payment
{

    protected $code = 'tfeb';

    private function getApiClient():Client{
        return new Client([
            'base_uri' => $this->getConfigData('api_url'),
            'connect_timeout' => 25,//sec
            'timeout' => 25,//sec
            'verify' => true,
            'header' =>[
                'ClientId' => $this->getConfigData('client_id'),
                'ClientSecret' => $this->getConfigData('client_secret'),
                'Accept' => "application/hal+json",
                "Content" => 'application/json'
            ],
        ]);
    }

    public function registerOrder(){

        $client = $this->getApiClient();

        $params =[
            'body' => new Order($this->getCart())
        ];

        return json_decode($client->post('',$params)->getBody(),true);

    }

    public function getRedirectUrl()
    {
        return route('paymentmethod.tfeb.redirect');
    }

    public function isRegistered(){
        $payment = $this->getCart()->payment;
        return (!empty($payment) && !empty($payment->orderId));
    }

    public function getOrderStatus(){
        $client = $this->getApiClient();
        $payment = $this->getCart()->payment;

        return json_decode($client->post($payment->order_id)->getBody(),true);
    }

    public function registerOrderId($orderId){
        $payment = $this->getCart()->payment;
        $payment->order_id = $orderId;
//        dd($payment);
//        $payment->paymentFormUrl = $formUrl;
        $payment->save();
    }
}
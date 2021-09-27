<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/22/2021
 * Time: 15:40
 */

namespace Payment\CardPayment;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
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
            'verify' => false,
            'headers' =>[
                'ClientId' => $this->getConfigData('client_id'),
                'ClientSecret' => $this->getConfigData('client_secret'),
                'Accept' => "application/hal+json",
                "Content-Type" => 'application/json'
            ],
        ]);
    }

    public function registerOrder(){

        $client = $this->getApiClient();

//        Log::info($this->getCart());

        $body = (new Order($this->getCart()))->toJson();

        Log::info($body);

        $params =[
            'body' => $body
        ];

        return $client->post('',$params)->getBody();

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

        return $client->post($payment->order_id)->getBody();
    }

    public function registerOrderId($orderId){
        $payment = $this->getCart()->payment;
        $payment->order_id = $orderId;
//        dd($payment);
//        $payment->paymentFormUrl = $formUrl;
        $payment->save();
    }
}
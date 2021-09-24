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
        ]);
    }

    public function registerOrder(){

        $cart = $this->getCart();
        $lifeTime = config('session.lifetime',10);//10 minutes

        $client = $this->getApiClient();

        $params =[
            'header' =>[
                'ClientId' => $this->getConfigData('client_id'),
                'ClientSecret' => $this->getConfigData('client_secret'),
                'Accept' => "application/hal+json",
                "Content" => 'application/json'
            ],
            'body' => new Order($this->getCart())
        ];

        return json_decode($client->post('',$params)->getBody(),true);

    }

    public function getRedirectUrl()
    {
        // TODO: Implement getRedirectUrl() method.
    }
}
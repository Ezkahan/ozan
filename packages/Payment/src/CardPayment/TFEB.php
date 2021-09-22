<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/22/2021
 * Time: 15:40
 */

namespace Payment\CardPayment;

use Webkul\Payment\Payment\Payment;

class TFEB extends Payment
{

    protected $code = 'tfeb';

    private function getApiClient():Client{
        return new Client([
            'base_uri' => $this->getConfigData('api_url'),
            'connect_timeout' => 10,
            'timeout' => 10,
            'verify' => true,
        ]);
    }

    public function registerOrder(){

        $cart = $this->getCart();
        $lifeTime = config('session.lifetime',10);//10 minutes

        $client = $this->getApiClient();

        $params =[
            'form_params' => [
                'userName' => $this->getConfigData('business_account'),//'103161020074',
                'password' => $this->getConfigData('account_password'),//'E12wKp7a7vD8',
                'sessionTimeoutSecs' => $lifeTime * 30, //(600 sec)
                'orderNumber' =>$cart->id . Carbon::now()->timestamp,
                'currency' => 934,
                'language' => 'ru',
                'description'=> "bagisto multivendor {$cart->grand_total}m.",
                'amount' =>$cart->grand_total * 100,// amount w kopeykah
                'returnUrl' => route('paymentmethod.altynasyr.success'),
                'failUrl' => route('paymentmethod.altynasyr.cancel')
            ],
        ];

        return json_decode($client->post('register.do',$params)->getBody(),true);

    }

    public function getRedirectUrl()
    {
        // TODO: Implement getRedirectUrl() method.
    }
}
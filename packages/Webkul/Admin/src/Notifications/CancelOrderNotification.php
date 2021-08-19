<?php


namespace Webkul\Admin\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Webkul\Admin\PUSH\Firebase;
use Webkul\Admin\SMS\CancellOrderSMS;

class CancelOrderNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function handle(){

        try{
            if($phone = $this->order['customer_email']) {
                (new CancellOrderSMS($this->order['id'], $phone))->send();
            }
            else{
                Log::warning("telefon nomer yoga houuu");

            }
        }
        catch(Exception $exception){
            report($exception);
        }

        try {
            if($f_token = $this->order->firebase_token)
            {
                (new Firebase($f_token,'Sargyt #'.$this->order->id, 'yatyryldy'))
                    ->send();
            }
            else{
                Log::warning('Orderin firebase_tokeni yok');
            }

        }
        catch (Exception $ex){
            report($exception);
        }

    }
}
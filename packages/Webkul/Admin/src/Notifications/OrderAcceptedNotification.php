<?php
namespace Webkul\Admin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Webkul\Admin\PUSH\Firebase;
use Webkul\Admin\SMS\AcceptOrderSMS;
use Exception;
class OrderAcceptedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        try{
            Log::info($this->order);
            if(!$phone = $this->order->customer_email) {
                (new AcceptOrderSMS($this->order->id, $phone))
                    ->send();
            }else{
                Log::warning("telefon nomer yoga houuu");
                Log::info($this->order);
            }
        }
        catch (Exception $e){
            report($e);
        }

        try{
            if($f_token = $this->order->firebase_token)
            {
                (new Firebase($f_token,'Sargyt #'.$this->order->id, 'kabul edildi'))
                    ->send();
            }else{
                Log::warning('Orderin firebase_tokeni yok');
            }
        }

        catch(Exception $ex) {
            report($ex);
        }



    }
}
<?php
namespace Webkul\Admin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
            if($f_token = $this->order->firebase_token)
            {
                (new Firebase($f_token,'Sargyt #'.$this->order->id, 'kabul edildi'))
                    ->send();
            }
        }

        catch(Exception $ex) {
            report($ex);
        }

        try{
            (new AcceptOrderSMS($this->order->id, $this->order->customer_email))
                ->send();
        }
        catch (Exception $e){
            report($e);
        }

    }
}
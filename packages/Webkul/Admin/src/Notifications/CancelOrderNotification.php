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
            if($f_token = $this->order['firebase_token'])
            {
                $data = [
                    'id' =>   $this->order['id'],
                    'title' => 'Sargyt #'.$this->order['id'].' ýatyryldy',
                    'content' => 'Siziň ozan.com.tm #'.$this->order['id'].' belgili sargydyňyz ýatyryldy',
                    'type' => 'order'
                ];
                (new Firebase($f_token,$data))
                    ->send();
            }

        }
        catch (Exception $ex){
            report($ex);
        }

    }
}
<?php


namespace Webkul\Admin\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Webkul\Admin\SMS\CancellOrder;

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
        $data = (object)[
            'messages' => [
                new CancellOrder($this->order)
            ],
            'validate' => false,
            "tags" => [
                date('Y'),
                "order",
                'cancel'
            ],
            "timeZone" => "Asia/Ashgabat"
        ];

        $response = Http::withHeaders([
            'X-Token' => 'uabv52b9nvqq3baar4xj12l00y7k1z709e7a2nlzgfz8k9co92mbns53irj47ht6',
            'Content-Type' => 'application/json'
        ])->withBody(json_encode($data),'application/json')
            ->timeout(30)
            ->post('https://lcab.smsint.ru/json/v1.0/sms/send/text');


        if($response->failed())
        {
            Log::error($response);
            $response->throw();
        }
    }
}
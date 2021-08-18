<?php

namespace Webkul\Admin\PUSH;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Firebase
{
    public $data;

    public  $priority;

    public $to;

    public $notification;

    public function __construct($to,$title,$body,$priority = 'high')
    {
        $this->data = [
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK'
        ];

        $this->to = $to;

        $this->notification = [
            'title' => $title,
            'body' => $body
        ];

        $this->priority = $priority;

    }

    public function send(){
        $response = Http::withHeaders([
            'Authorization' => config('notification.push.token'),
            'Content-Type' => 'application/json'
        ])->withBody(json_encode($this),'application/json')
            ->timeout(30)
            ->post(config('notification.push.url'));


        if($response->failed())
        {
            Log::error($response);
            $response->throw();
        }
    }
}
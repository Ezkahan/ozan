<?php

namespace Webkul\Admin\SMS;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class SMS
{
    public $recipientType = "recipient";
    public $source = 'ozan.com.tm';
//    public $groupId = 'customer';
    public $shortenUrl = true;
    public $timeout = 300;
    public $recipient;
    public $text;
    public $id;

    public function  send(){
        $data = json_encode((object)[
            'messages' => [
                $this
            ],
            'validate' => false,
            "tags" => $this->tags(),
            "timeZone" => "Asia/Ashgabat"
        ]);
        Log::info("sending sms to: ".$this->recipient);
        Log::info($data);
        $response = Http::withHeaders([
            'X-Token' => config('notification.sms.token'),
            'Content-Type' => 'application/json'
        ])->withBody($data,'application/json')
            ->timeout(30)
            ->post(config('notification.sms.url'));


        if($response->failed())
        {
            $response->throw();
        }
    }

    abstract function tags();
}
<?php


namespace Webkul\Customer\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;
use Webkul\Customer\SMS\VerificationSMS;

class PhoneVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    public $verificationData;

    public $tries = 2;
    /**
     * Create a new mailable instance.
     *
     * @param  array  $verificationData
     * @return void
     */
    public function __construct($verificationData)
    {
        $this->verificationData = $verificationData;
    }

    public function handle(){

        $data = (object)[
            'messages' => [
                new VerificationSMS($this->verificationData)
            ],
            'validate' => false,
            "tags" => [
                date('Y'),
                "verification"
            ],
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
    public function failed(Throwable $exception)
    {
        report($exception);
    }
}
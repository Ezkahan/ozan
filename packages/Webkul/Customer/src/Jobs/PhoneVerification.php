<?php


namespace Webkul\Customer\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
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
            'X-Token' => 'adq2ryioqifw',
            'Content-Type' => 'application/json'
        ])->withBody(json_encode($data),'application/json')
            ->timeout(30)
            ->post('https://lcab.smsint.ru/json/v1.0/sms/send/text');

        if($response->failed())
            $response->throw();

    }
    public function failed(Throwable $exception)
    {
        report($exception);
    }
}
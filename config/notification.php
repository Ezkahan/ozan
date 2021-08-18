<?php
return [
    'sms' => [
        'url'=> env('SMS_URL', 'https://lcab.smsint.ru/json/v1.0/sms/send/text'),
        'token' =>  env('SMS_TOKEN','uabv52b9nvqq3baar4xj12l00y7k1z709e7a2nlzgfz8k9co92mbns53irj47ht6')
    ],
    'push' => [
        'url'=> env('PUSH_URL', 'https://lcab.smsint.ru/json/v1.0/sms/send/text'),
        'token' =>  env('PUSH_TOKEN','key=uabv52b9nvqq3baar4xj12l00y7k1z709e7a2nlzgfz8k9co92mbns53irj47ht6')
    ]
];
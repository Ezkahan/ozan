<?php
return [
    'sms' => [
        'url'=> env('SMS_URL', 'https://lcab.smsint.ru/json/v1.0/sms/send/text'),
        'token' =>  env('SMS_TOKEN','uabv52b9nvqq3baar4xj12l00y7k1z709e7a2nlzgfz8k9co92mbns53irj47ht6')
    ],
    'push' => [
        'url'=> env('PUSH_URL', ' https://fcm.googleapis.com/fcm/send'),
        'token' =>  env('PUSH_TOKEN','key=AAAA9LHgcmM:APA91bHkC0wGvNhfoD6UlzUsSilSnhAghY27PNpCwbte4AG0zN2LTnbxVtgcU4q5hwPUfcJuAiL00Ioh2XCEasDW6GYs9IZR4MbbholyASABU6aoQjq95aGpuwci-z_oD2-p1m7COwcO')
    ]
];
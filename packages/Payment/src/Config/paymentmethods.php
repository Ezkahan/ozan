<?php
return [
    'altynasyr' =>[
        'code' => 'altynasyr',
        'title' => 'Altyn Asyr',
        'description' => 'Altyn Asyr Kartly Töleg',
        'api_url' => 'https://mpi.gov.tm/payment/rest/',
        'class' => 'Payment\CardPayment\AltynAsyr',
        'active' => false,
        'sort' => 4
    ],
    'tfeb' =>[
        'code' => 'tfeb',
        'title' =>'TFEB',
        'description' => 'THE STATE BANK FOR FOREIGN ECONOMIC AFFAIRS OF TURKMENISTAN',
        'api_url' => 'https://mpi.gov.tm/payment/rest/',
        'class' => 'Payment\CardPayment\TFEB',
        'active' => true,
        'sort' => 5
    ]
];
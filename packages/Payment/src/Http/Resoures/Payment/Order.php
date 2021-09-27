<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/22/2021
 * Time: 18:24
 */

namespace Payment\Http\Resoures\Payment;


use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class Order extends JsonResource
{
    public function getConfigData($field)
    {
        return core()->getConfigData('sales.paymentmethods.tfeb.' . $field);
    }

    public function toArray($request){
        return  [
            "RequestId" => $this->id,
            "Environment" => [
                "Merchant" => [
                    "Id" =>$this->getConfigData('merchant')
                ],
                "POI" => [
                    "Id" => $this->getConfigData('terminal'),
                    "Language" => "en-EN"
                ],
                "transport" => [
                    "merchantFinalResponseUrl" => route('paymentmethod.tfeb.complete',['id'=>$this->id])
                ]
                //"Card" => Card::make($this->card),
               // "Customer" => Cusromer::make($this->customer),

//                "CustomerDevice" => [
//                    "Browser" => Browser::make($this->browser),
//                    "MobileApp" => null,
//                ]
            ],
            "Transaction" => [
                "InvoiceNumber" => $this->id,
                "Type" => "CRDP",
                "TransactionText" => "ozan online sowda",
                "TotalAmount" => (double)$this->grand_total,
                "Currency" => "934",
                "MerchantOrderId" => $this->id,
                "AutoComplete" => false
            ]
        ];
    }
}
/**
 * 	{
"RequestId": "4",
"Environment": {
"Merchant": {
"Id": "300000000000011"
},
"POI": {
"Id": "30000011",
"Language": "ru-RU"
},
"Card": {
"PAN": "6015840000000843",
"ExpiryDate": "2401",
"SecurityCode2": "725",
"Name": "John Doe",
"TAVV": null,
"IsCardOnFile": false
},
"Customer": {
"Name": "John Doe",
"Language": "en-US",
"Email": "john.doe@email.com",
"MobilePhone": {
"cc": "993",
"subscriber": "63432211"
}
},
"CustomerDevice": {
"Browser": {
"AcceptHeader": "\*\/\\*",
				"IpAddress": "10.33.27.3",
				"Language": "en-US",
				"ScreenColorDepth": 48,
				"ScreenHeight": 1200,
				"ScreenWidth": 1900,
				"UserAgentString": "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.3"
				},
				"MobileApp": null
			}

		},
		"Transaction": {
			"InvoiceNumber": "2",
			"Type": "CRDP",
			"TransactionText":"sowda",
			"TotalAmount": 1.99,
			"Currency": "934",
			"MerchantOrderId": 11,
			"AutoComplete": false
		}
	}
 */
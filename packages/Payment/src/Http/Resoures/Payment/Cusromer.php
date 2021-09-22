<?php
/**
 * Created by PhpStorm.
 * User: merdan
 * Date: 9/22/2021
 * Time: 18:36
 */

namespace Payment\Http\Resoures\Payment;


use Illuminate\Http\Resources\Json\JsonResource;

class Cusromer extends JsonResource
{
    public function toArray($request)
    {
        return [
            "Name" => "John Doe",
            "Language" => "en-US",
            "Email" => "john.doe@email.com",
            "MobilePhone" => [
                "cc" => "993",
                "subscriber" => "63432211"
            ]
        ];
    }
}
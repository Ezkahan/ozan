<?php

namespace Payment\Http\Resoures\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class CartAddress extends JsonResource
{
    public function toArray($request)
    {
        return [
            "SameAsShipping" => true,
        "Line1"=> substr($this->address1,0,50),//Line1 must be max 50 chars
        "Line2"=> substr($this->address2,0,50),
        "PostCode"=> "74000",
        "City"=> "01",
        "CountrySubdivision"=> "01",
        "Country"=> "196"
        ];
    }
}
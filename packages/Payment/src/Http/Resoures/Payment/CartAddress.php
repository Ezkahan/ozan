<?php

namespace Payment\Http\Resoures\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class CartAddress extends JsonResource
{
    public function toArray($request)
    {
        return [
            "SameAsShipping" => true,
        "Line1"=> $this->address1,
        "Line2"=> $this->address2,
        "PostCode"=> "74000",
        "City"=> "01",
        "CountrySubdivision"=> "01",
        "Country"=> "196"
        ];
    }
}
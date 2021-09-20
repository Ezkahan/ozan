<?php

namespace Webkul\API\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;

class Attribute extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'code'        => $this->code,
            'type'        => $this->type,
            'name'        => $this->name,
            'swatch_type' => $this->swatch_type,
            'options'     => AttributeOption::collection($this->options),
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }

    private function getOptions(){
//        dd($this->options);
        if($this->swatch_type==='image'){
            return collect(array_map(function ($item){
                $item->swatch_value = $item->swatch_value_url;
                return $item;

                },$this->options->toArray()));
        }
        return $this->options;
    }
}
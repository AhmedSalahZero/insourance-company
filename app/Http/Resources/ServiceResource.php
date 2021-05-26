<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'=>$this->id ,
            'name'=>$this->name ,
            'price_from'=>$this->when($this->pivot , floatval(optional($this->pivot)->price_from)),
            'price_to'=>$this->when($this->pivot , floatval(optional($this->pivot)->price_to)),
        ];


    }
}

<?php

namespace App\Http\Resources;

use App\Rules\positiveNumberRule;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotaResource extends JsonResource
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
            'name'=>$this->name ,
            'price'=>$this->price ,

        ];
    }

    public function with($request)
    {
        return [
            'features'=>$this->features
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceTypeResource extends JsonResource
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
            'price'=>$this->when($this->pivot , optional($this->pivot)->price) ,
            'service'=> new ServiceResource($this->service)
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'name'=>$this->when($this->name , $this->name) , 
            'govern'=>$this->govern , 
            'area'=>$this->area , 
            'street'=>$this->street , 
            'building'=>$this->building , 
            'floor'=>$this->floor , 
            'flat_number'=>$this->flat_number , 
            'user'=> new UserResource($this->user) , 

        ];
    }
}

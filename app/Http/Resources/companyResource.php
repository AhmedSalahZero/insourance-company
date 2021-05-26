<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class companyResource extends JsonResource
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
            'phone'=>$this->phone , 
            'address'=>$this->address , 
            'email'=>$this->email , 
            'description'=>$this->description,
            'logo'=>$this->logo
        ];
    }
}

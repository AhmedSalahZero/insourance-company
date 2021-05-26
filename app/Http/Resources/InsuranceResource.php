<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InsuranceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user'=>$this->user->name ,
            'address'=>$this->address->name ,
            'company'=>$this->company->name ,
            'service'=>$this->service->name ,
            'service_type'=>$this->serviceType->name ,
            'price'=>$this->price ,
            'car'=>$this->when($this->car , optional($this->car)->name) ,
            'carType'=>$this->when($this->car , optional($this->carType)->name) ,
            'estimate_val'=>$this->when($this->car , $this->est_val) ,
            'seats_number'=>$this->when($this->car , $this->seats_no) ,
            'quota'=>$this->when($this->quota , $this->quota->name),
            'people_number'=>$this->when($this->people_no , $this->people_no),
            'front_image'=>$this->front_image,
            'back_image'=>$this->back_image ,
            'receiver_number'=>$this->receiver_number ,
            'duration'=>$this->when($this->duration ,$this->duration),


        ];
    }
}

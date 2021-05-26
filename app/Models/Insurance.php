<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' ,'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class ,'address_id' ,'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class ,'service_id' ,'id');
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class ,'service_type_id' ,'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class ,'company_id' ,'id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class,'car_id' ,'id');
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class,'car_type_id' ,'id');
    }

    public function liabilityLimit()
    {
        return $this->belongsTo(LiabilityLimit::class,'limit_id','id');
    }

    public function quota()
    {
        return $this->belongsTo(Quota::class,'quota_id','id');
    }


}

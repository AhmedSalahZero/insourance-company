<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany ;


class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'email' , 'address' , 'phone' , 'description', 'logo'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot(['price_from','price_to']);
    }

    public function servicesType()
    {
        return $this->belongsToMany(ServiceType::class ,'company_service_type' , 'company_id','service_type_id')
            ->withPivot(['price']);

    }

    public function countServices()
    {
        return $this->services()->count();
    }

    public function insurances()
    {
        return $this->hasMany(Insurance::class ,'company_id' ,'id');
    }


}

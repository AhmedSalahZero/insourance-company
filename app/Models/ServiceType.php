<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\DataBase\Eloquent\Relations\BelongsTo ;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id' , 'name'
    ];

    public function service()
    {
        return $this->BelongsTo(Service::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class ,'company_service_type' ,'service_type_id' ,'company_id');
    }

    public function insurances()
    {
        return $this->hasMany(Insurance::class ,'service_type_id' ,'id');
    }

}

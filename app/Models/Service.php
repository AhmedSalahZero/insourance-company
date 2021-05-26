<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany ;
use Illuminate\Database\Eloquent\Relations\hasMany ;


class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function types()
    {
        return $this->hasMany(ServiceType::class);
    }
    public function insurances()
    {
        return $this->hasMany(Insurance::class ,'service_id' ,'id');
    }


}

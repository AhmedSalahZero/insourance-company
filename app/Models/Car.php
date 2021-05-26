<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo' , 'name'
    ];

    public function types():hasMany
    {
        return $this->hasMany(CarType::class , 'car_id' , 'id');
    }

    public function insources()
    {
        return $this->hasMany(Insurance::class,'car_id' ,'id');
    }

}

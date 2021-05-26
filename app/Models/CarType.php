<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,  'car_id'
    ];

    public function car():belongsTo
    {
        return $this->belongsTo(Car::class , 'car_id','id');
    }

    public function insurances()
    {
        return $this->hasMany(Insurance::class,'car_type_id' ,'id');
    }



}

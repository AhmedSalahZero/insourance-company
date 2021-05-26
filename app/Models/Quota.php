<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'price'
    ];


    public function features()
    {
        return $this->hasMany(Feature::class , 'quota_id' , 'id');

    }

    public function insurances()
    {
        return $this->hasMany(Insurance::class ,'quota_id' , 'id');
    }

}

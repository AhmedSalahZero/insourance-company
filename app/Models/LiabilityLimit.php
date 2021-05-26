<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiabilityLimit extends Model
{
    use HasFactory;

    protected $fillable = [
        'limit' , 'price'
    ];

    public function insurances()
    {
        return $this->hasMany(Insurance::class ,'limit_id','id');
    }



}

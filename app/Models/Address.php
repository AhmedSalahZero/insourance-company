<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Address extends Model
{

    use HasFactory;

    protected $fillable =[
        'name' , 'user_id' ,'default' , 'govern','area','street','building','floor','flat_number',''
    ];

    public function setDefaultAttribute($value)
    {
        $this->attributes['default'] = ($value == true) ;
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function insources()
    {
        return $this->hasMany(Insurance::class ,'address_id' ,'id');
    }


    /* public function setDefaultAttribute()
    {

      //  $this->attribute['default'] = true ;
    } */
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature' , 'quota_id'
    ];

    public function quota()
    {
        return $this->belongsTo(Quota::class ,'quota_id' ,'id');

    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $guarded=[''];
    // protected $casts=[
    //     'particular_json'=>'array'
    // ];

    public function particulars()
    {
        return $this->hasMany(EstimateParticular::class,'default_estimate_particular_id');
    }
}

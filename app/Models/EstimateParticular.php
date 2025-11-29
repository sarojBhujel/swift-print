<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateParticular extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $casts = [
        'quantity' => 'float',
        'rate' => 'float',
        'amount' => 'float',
    ];
    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'estimate_id');
    }
    
}

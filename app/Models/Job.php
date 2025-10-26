<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function papers()
    {
        return $this->belongsTo(Paper::class,'paper_id');
    }
    public function equipments()
    {
        return $this->belongsTo(Equipment::class,'equipment_id');
    }
}

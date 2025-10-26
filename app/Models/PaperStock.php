<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperStock extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function papers()
    {
        return $this->belongsTo(Paper::class,'paper_id');
    }
}

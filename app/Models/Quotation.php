<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = [];
    // public function customers()
    // {
    //     return $this->belongsTo(Customer::class,'customer_id');
    // }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            $latestQuotation = static::latest()->first();

            // If there are no existing quotations, start with quotation_code 1
            $nextQuotationCode = ($latestQuotation) ? $latestQuotation->quotation_no + 1 : 1;

            $quotation->quotation_no = $nextQuotationCode;
        });
    }
}

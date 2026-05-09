<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'faktur_no',
        'supplier_id',
        'purchase_date',
        'total_amount',
    ];
}
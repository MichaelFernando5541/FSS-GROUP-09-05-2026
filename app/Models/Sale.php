<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_no',
        'customer_id',
        'customer_name', // Untuk pelanggan walk-in yang tidak ada di database
        'sales_name',
        'sale_date',
        'total_amount',
        'payment_status',
    ];
}
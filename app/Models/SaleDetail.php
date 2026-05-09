<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'sale_id',
        'item_id',
        'qty',
        'price',
        'subtotal',
    ];
}
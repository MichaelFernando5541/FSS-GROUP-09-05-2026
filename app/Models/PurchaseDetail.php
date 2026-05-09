<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id',
        'item_id',
        'qty',
        'modal',
        'subtotal',
    ];
}
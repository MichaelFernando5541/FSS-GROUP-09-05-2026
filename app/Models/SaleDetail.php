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

    // Fungsi ini wajib ada di sini agar Laravel tahu detail ini milik item mana
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Ini memberi izin kepada Laravel untuk menyimpan data ke kolom-kolom ini
    protected $fillable = [
        'category_id',
        'name',
        'modal',
        'price',
        'stock',
    ];
}
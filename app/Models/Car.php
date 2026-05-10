<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopol',
        'no_rangka',
        'no_mesin',
        'merk',
        'tipe',
        'tahun',
        'kondisi',
        'harga_beli',
        'biaya_operasional',
        'status',
    ];
}
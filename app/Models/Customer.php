<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. TAMBAHKAN INI
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nama', 
        'nik_npwp', // <--- Tambahkan baris ini
        'telepon', 
        'alamat'
    ];
    protected $guarded = ['id'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nama', 
        'nik_npwp', // <--- Tambahkan baris ini
        'telepon', 
        'alamat'
    ];
}
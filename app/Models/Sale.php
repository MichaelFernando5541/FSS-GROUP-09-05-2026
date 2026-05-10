<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Pastikan 'total_amount' ada di dalam kurung siku ini!
   protected $fillable = [
    'invoice_no', 
    'sale_date', 
    'customer_id', 
    'customer_name', // Tambahkan ini
    'car_id', 
    'total_amount', 
    'payment_status',
    'sales_name', // Tambahkan ini
];

    // ... relasi ke model lain ...


    // Mendaftarkan relasi ke tabel Unit Mobil
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
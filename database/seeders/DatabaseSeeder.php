<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Master Admin CV. Nusantara Motor
        User::create([
            'name' => 'AdminSementara', // Nama Anda sebagai Master
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), // Silakan ganti sandinya nanti
            'role' => 'admin', 
        ]);

        // Opsional: Buat akun Kasir untuk simulasi
        User::create([
            'name' => 'KasirSementara',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);
    }
}
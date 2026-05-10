<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        
        // Data Legalitas & Spesifikasi
        $table->string('nopol')->unique();
        $table->string('no_rangka')->unique();
        $table->string('no_mesin')->unique();
        $table->string('merk');
        $table->string('tipe'); // Tipe atau Model
        $table->integer('tahun');
        $table->string('kondisi'); // Contoh: Bekas Baik, Perlu Perbaikan
        
        // Data Finansial (Pakai bigInteger untuk nilai uang besar)
        $table->bigInteger('harga_beli'); 
        $table->bigInteger('biaya_operasional')->default(0); 
        
        // Status Ketersediaan
        $table->enum('status', ['Tersedia', 'Terjual'])->default('Tersedia');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

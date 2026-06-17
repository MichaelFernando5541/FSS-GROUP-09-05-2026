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
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        // Pastikan kolom-kolom ini ada dan namanya sama persis
        $table->string('nama');
        $table->string('nik_npwp')->nullable(); // nullable() agar boleh kosong
        $table->string('telepon');
        $table->text('alamat');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

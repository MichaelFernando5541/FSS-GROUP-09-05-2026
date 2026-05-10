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
    Schema::table('sales', function (Blueprint $table) {
        $table->foreignId('car_id')->nullable()->constrained('cars')->onDelete('cascade'); // Menghubungkan ke mobil spesifik
        $table->bigInteger('tax_amount')->default(0); // Nilai PPh [cite: 20, 171]
        $table->bigInteger('roi_amount')->default(0); // Nilai keuntungan bersih per unit [cite: 188, 303]
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
};

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
    Schema::create('purchases', function (Blueprint $table) {
        $table->id();
        $table->string('faktur_no')->unique(); // Ini kolom yang tadi hilang
        $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
        $table->date('purchase_date');
        $table->bigInteger('total_amount')->default(0);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

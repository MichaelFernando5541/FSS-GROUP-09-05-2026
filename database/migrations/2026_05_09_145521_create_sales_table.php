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
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_no')->unique();
        $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
        $table->string('customer_name')->nullable();
        $table->string('sales_name');
        $table->date('sale_date');
        $table->string('payment_status'); // Tipe data 'string' agar bisa menerima "Lunas" / "Belum Lunas"
        $table->bigInteger('total_amount')->default(0);
        $table->timestamps();
    });
}   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

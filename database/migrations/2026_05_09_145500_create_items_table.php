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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        // This links the item to the categories table
        $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
        $table->string('name');
$table->bigInteger('modal')->default(0);
    $table->bigInteger('price')->default(0);
    // biarkan 'stock' tetap integer karena stok barang jarang sampai miliaran pcs
    $table->integer('stock')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('customers', function (Blueprint $table) {
        // Menambahkan kolom nik_npwp (Boleh kosong/nullable jika pelanggan tidak mau ngasih)
        $table->string('nik_npwp')->nullable()->after('nama');
    });
}

public function down()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->dropColumn('nik_npwp');
    });
}
};

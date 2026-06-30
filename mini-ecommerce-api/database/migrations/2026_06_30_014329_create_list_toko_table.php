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
       Schema::create('list_toko', function (Blueprint $table) {
            $table->id('ID');
            $table->string('NAMA_TOKO', 100);
            $table->string('FOTO_TOKO', 255)->default('default_toko.png');
            $table->string('QRIS', 250)->nullable();
            $table->unsignedBigInteger('id_penjual')->nullable(); // Menghubungkan 1 toko ke 1 akun penjual
            $table->enum('STATUS', ['1', '0'])->default('1');
            $table->timestamps();

            $table->foreign('id_penjual')->references('ID')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_toko');
    }
};

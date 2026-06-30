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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('ID_KERANJANG');
            $table->unsignedBigInteger('ID_USER'); // UPPERCASE!
            $table->unsignedBigInteger('ID_PRODUK'); // UPPERCASE!
            $table->integer('QTY')->default(1); // UPPERCASE!
            $table->timestamps();

            // Constraint unik biar ga duplikat
            $table->unique(['ID_USER', 'ID_PRODUK']);

            // Foreign Key
            $table->foreign('ID_USER')->references('ID')->on('users')->onDelete('cascade');
            $table->foreign('ID_PRODUK')->references('ID_PRODUK')->on('tb_produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};

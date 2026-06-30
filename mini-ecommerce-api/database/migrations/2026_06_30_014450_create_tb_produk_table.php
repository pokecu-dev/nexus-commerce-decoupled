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
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id('ID_PRODUK');
            $table->unsignedBigInteger('ID_TOKO')->nullable(); // FK ke tabel toko di atas
            $table->string('NAMA_PRODUK', 150);
            $table->string('HARGA', 15);
            $table->enum('KATEGORI', ['makanan', 'minuman', 'snack', 'pakaian', 'elektronik', 'umum'])->default('umum'); // Gue tambahin biar ala Tokped asli
            $table->integer('STOK')->default(0);
            $table->enum('STATUS', ['tersedia', 'habis', 'nonaktif'])->default('tersedia');
            $table->string('FOTO_PRODUK', 255)->nullable();
            $table->text('DESK')->nullable();
            $table->decimal('RATING', 2, 1)->nullable();
            $table->timestamps();

            // FK ke tabel toko
            $table->foreign('ID_TOKO')->references('ID')->on('list_toko')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produk');
    }
};

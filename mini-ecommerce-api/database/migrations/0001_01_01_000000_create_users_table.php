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
        Schema::create('users', function (Blueprint $table) {
            $table->id('ID'); 
            $table->string('USERNAME', 100)->unique();
            $table->string('PASS', 100);
            $table->string('NAMA_LENGKAP', 150)->nullable();
            $table->string('NO_TLP', 18)->unique()->nullable();
            $table->string('EMAIL', 100)->unique()->nullable();
            $table->enum('ROLE', ['PEMBELI', 'PENJUAL', 'ADMIN']);
            $table->string('FOTO_USERS', 100)->default('default.jpg');
            $table->enum('STATUS', ['1', '0', 'delete'])->default('1');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_guru')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_guru')->nullable();
            $table->string('no_whatsapp')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->text('password')->nullable();
            $table->string('level')->nullable();
            $table->foreignId('akun_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};

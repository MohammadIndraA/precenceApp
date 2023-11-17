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
            $table->id();
            $table->string('nis')->unique()->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('no_telepon')->nullable();
            $table->text('nama_ortu')->nullable();
            $table->string('no_telepon_ortu')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->integer('is_aktip')->default(0);
            $table->foreignId('kelas_id')->nullable();
            $table->foreignId('akun_id')->nullable();
            $table->foreignId('presensi_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('level')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

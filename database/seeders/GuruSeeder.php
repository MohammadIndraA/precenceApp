<?php

namespace Database\Seeders;

use App\Models\guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        guru::factory()->create([
            'kode_guru' => Str::random(10),
            'nip' => Str::random(10),
            'nama_guru' => fake()->name(),
            'no_whatsapp' => fake()->phoneNumber(),
            'alamat_lengkap' => fake()->address(),
            'akun_id' => mt_rand(1,3),
        ]);
    }
}

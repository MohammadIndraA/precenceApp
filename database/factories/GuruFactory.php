<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_guru' => Str::random(10),
            'nip' => Str::random(10),
            'nama_guru' => fake()->name(),
            'no_whatsapp' => fake()->phoneNumber(),
            'alamat_lengkap' => fake()->address(),
            'akun_id' => mt_rand(1,3),
        ];
    }
}

<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon as IlluminateCarbon;
IlluminateCarbon::setLocale('id');
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class mataPelajaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hari = [
           'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu',
        ];
        $index = 1;

        return [
            'kode_pelajaran' => Str::random(10),
            'mata_pelajaran' => fake()->city(),
            'hari' =>  $hari[$index+1],
            'jam' => '10:00',
            'kelas_id' => mt_rand(1,3),
            'guru_id' => mt_rand(1,10),
        ];
    }
}

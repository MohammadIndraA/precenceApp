<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\barcode;
use App\Models\guru;
use App\Models\kelas;
use App\Models\mataPelajaran;
use App\Models\presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon as IlluminateCarbon;
IlluminateCarbon::setLocale('id');
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
      
        User::factory(5)->create();
        guru::factory(5)->create();
        kelas::factory(3)->create();
        barcode::factory(10)->create();
        mataPelajaran::factory(10)->create();
      

        presensi::factory(10)->create([
            'user_id' => mt_rand(1,5),
            'barcode_id' => mt_rand(1,10),
        ]);

    }
}

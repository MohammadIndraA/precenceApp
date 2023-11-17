<?php

namespace Tests\Feature;

use App\Models\akun;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $response = $this->get('login');
        $response->assertStatus(200);
    }
    public function test_loginPage(): void
    {
        $akun = akun::create([
            'nisp' => '937902077',
            'password' =>Hash::make(123),
            'level' => 'siswa',
        ]);
        $response = $this->post('login', [
            'nisp' => '937902077',
            'password' => 123,
        ]);

        $response->assertStatus(200);
    }
}

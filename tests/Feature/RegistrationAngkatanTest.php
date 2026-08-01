<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationAngkatanTest extends TestCase
{
    use RefreshDatabase;

    public function test_mahasiswa_registration_requires_angkatan_as_four_digit_number(): void
    {
        User::factory()->create([
            'role' => 'dosen',
            'email' => 'dosen@example.com',
        ]);

        $response = $this->post('/register', [
            'name' => 'Test Mahasiswa',
            'email' => 'mahasiswa@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'kelas' => 5,
            'angkatan' => 202,
            'dosen_id' => User::where('role', 'dosen')->first()->id,
        ]);

        $response->assertSessionHasErrors('angkatan');
    }
}

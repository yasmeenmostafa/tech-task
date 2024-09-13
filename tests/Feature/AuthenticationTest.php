<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
    
    public function it_allows_users_to_login_with_correct_credentials()
    {
        // Arrange
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        // Act
        $response = $this->post('/api/login', $credentials);

        // Assert
        $response->assertStatus(200); // Assuming successful login returns HTTP 200
        $response->assertJsonStructure([
            'token', // Adjust according to your response structure
        ]);
    }

    /** @test */
    public function it_denies_login_with_incorrect_credentials()
    {
        // Arrange
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ];

        // Act
        $response = $this->post('/api/login', $credentials);

        // Assert
        $response->assertStatus(401); // Assuming unsuccessful login returns HTTP 401
        $response->assertJson([
            'message' => 'Unauthorized', // Adjust according to your response structure
        ]);
    }
}

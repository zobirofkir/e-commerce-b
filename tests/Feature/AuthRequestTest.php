<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);  
    }

    /**
     * Test Get Cuttent User.
     */
    public function testGetCurrentUser()
    {
        $user = $this->authenticate();
        $response = $this->get("api/auth/current/$user");
        $response->assertStatus(200);
    }

    /**
     * Test Update Current Password
     */
    public function testUpdatePassword()
    {
        $user = $this->authenticate();
        $factory = User::factory()->create([
            'password' => Hash::make('password'),
        ]);
    
        // Send the request payload with the necessary fields
        $response = $this->put("/api/auth/update/$user", [
            'password' => 'NewPassword123',
            'password_confirmation' => 'NewPassword123',
            'actual_password' => 'password',
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test Logout User
     */
    public function testLogoutUser()
    {
        $user = $this->authenticate();
        $response = $this->get("/api/auth/logout/$user");
        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Authenticates User
     *
     * @return void
     */
    protected function authenticate()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);  
    }

    /**
     * Test Get Users
     */
    public function testGetUsers()
    {
        $this->authenticate();
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }

    /**
     * Test Create User
     */
    public function testCreateUser()
    {
        $this->authenticate();
        $postForm = [
            "name" => "zobir",
            "email" => "zobirofkir19@gmail.com",
            "password" => "medalVOODOO123@@@"
        ];
        $response = $this->post("/api/users", $postForm);
        $response->assertStatus(201);
    }

    /**
     * Test Update User
     */
    public function testUpdateUser()
    {
        $this->authenticate();
        $user = User::factory()->create();
    
        $updateForm = [
            "name" => "ofkir",
            "email" => "zobirofkir19@gmail.com",
            "password" => "medalVOODOO123@@@"
        ];    
        $response = $this->put("api/users/{$user->id}", $updateForm);
    
        $response->assertStatus(200);
    
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'ofkir',
            'email' => 'zobirofkir19@gmail.com',
        ]);
    }
    
    /**
     * Test Delete User
     */
    public function testDeleteUser()
    {
        $this->authenticate();
        $user = User::factory()->create();
        $response = $this->delete("api/users/$user->id");
        $response->assertStatus(200);
    }
}

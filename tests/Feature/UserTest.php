<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Create User
     */
    public function testCreateUser()
    {
        $user = User::factory()->create();
        $this->assertDatabaseHas("users", $user->toArray());
    }

    /**
     * Test get Users
     */
    public function testGetUsers()
    {
        $user = User::factory()->make();
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * Test Update User
     */
    public function testUpdateUser()
    {
        $user = User::factory()->create();
        $user->update([
            "name" => "zobir"
        ]);
        $this->assertDatabaseHas("users", $user->toArray());
    }

    /**
     * Test Delete User
     */
    public function DeleteUser()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->assertDatabaseEmpty("users");
    }
}

<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductRequestTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Authenticate Routes
     *
     * @return void
     */
    protected function authenticate()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);  
    }


    /**
     * Test Create Products
     */
    public function testCreateProducts()
    {
        $this->authenticate();
        $user = User::factory()->create();
        $registerForm = [
            "name" => "zobir",
            "price" => "10dh",
            "image" => "pathImage",
            "description" => "hrllo world",
            "additionalInfo" => "Testing Hallow"
        ];
        $response = $this->post("api/users/$user->id/products", $registerForm);
        $response->assertStatus(201);
    }

    /**
     * Test Get Products
     */
    public function testGetProducts()
    {
        $this->authenticate();
        $user = User::factory()->create();
        $response = $this->get("api/users/$user/products");
        $response->assertStatus(200);
    }
}

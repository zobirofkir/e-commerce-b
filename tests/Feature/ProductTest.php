<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Create Product
     */
    public function testCreateProduct()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            "user_id" => $user->id
        ]);
        $this->assertDatabaseHas("products", $product->toArray());
    }

    /**
     * Test Get Products
     */
    public function testGetProducts()
    {
        $user = User::factory()->create();
        $product = Product::factory()->make([
            "user_id" => $user->id
        ]);
        $this->assertInstanceOf(Product::class, $product);
    }

    /**
     * Test Update Product
     */
    public function testUpdateProduct()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            "user_id" => $user->id
        ]);
        $product->update([
            "name" => "product one"
        ]);

        $this->assertDatabaseHas("products", $product->toArray());
    }

    /**
     * Test Delete Product
     */
    public function testDeleteProduct()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            "user_id" => $user->id
        ]);
        $product->delete();
        $this->assertDatabaseMissing("products", $product->toArray());
    }
}

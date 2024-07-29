<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "price" => $this->faker->randomFloat(2, 1, 100),
            "image" => $this->faker->image(),
            "description" => $this->faker->text(),
            "additionalInfo" => $this->faker->title()
        ];
    }
}

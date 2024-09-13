<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Obsession',
            'price' => fake()->numberBetween(1, 10000),
            'quantity' => fake()->numberBetween(1, 1000),
            'description' => 'any description',
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ];
    }
}
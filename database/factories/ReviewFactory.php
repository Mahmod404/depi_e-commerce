<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $arr = ['1', '2', '3', '4', '5'];
        return [
            'rating' => Arr::random($arr),
            'comment' => 'Review',
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
        ];
    }
}
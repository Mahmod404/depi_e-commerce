<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $arr = ['male', 'female', 'kids'];
        return [
            'name' =>  Arr::random($arr),
            'description' =>  'Cate description.',
        ];
    }
}
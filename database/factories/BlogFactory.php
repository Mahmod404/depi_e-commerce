<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'Blog name',
            'description' => 'description',
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => '1 Million',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Sauvage',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Blue de chanael',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Boss',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Bad Boy',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Eros',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Y',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Stronger with you',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Myslf',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Toy Boy',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Chanel Pour Monsieur',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Loves Baby Soft',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Blue Stratos',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Violetta',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Paris',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Obsession',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Lumière',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Red Door',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Eternity',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
        Product::create([
            'name' => 'Escape',
            'description' => 'Product 1 description',
            'price' => 100,
            'quantity' => 10,
            'image' => 'imgs',
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ]);
    }
}
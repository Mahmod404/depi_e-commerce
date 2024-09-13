<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $order_quantity = fake()->numberBetween(0, $product->quantity);
        $product->quantity = $product->quantity - $order_quantity;
        $product->save();
        $order = Order::inRandomOrder()->first();
        $order->total_amount += $product->price * $order_quantity;
        $order->save();
        return [
            'price' => $product->price,
            'quantity' => $order_quantity,
            'order_id' => $order->id,
            'product_id' => $product->id,
        ];
    }
}
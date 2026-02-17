<?php

namespace Database\Factories\Order;

use App\Models\Order\Order;
use App\Models\Order\OrderDetails;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order\OrderDetails>
 */
class OrderDetailsFactory extends Factory
{
    protected $model = OrderDetails::class;
    /**
     * Define the model's default state.
     *
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Fetch a random order and product.  These should exist before creating order details.
        $order = Order::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();

        return [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $product->price,
            'title' => $this->faker->unique()->sentence(),
        ];
    }
}

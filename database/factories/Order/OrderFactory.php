<?php

namespace Database\Factories\Order;

use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        return [
            'order_number' => uniqid(),
            'name' => $this->faker->name(),
            'user_id' => $user->id,
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'delivary_area' => $this->faker->numberBetween(1, 5), // Example delivery area values
            'amount' => $this->faker->numberBetween(100, 10000),
            'discount' => $this->faker->numberBetween(0, 100),
            'shipping_charge' => $this->faker->numberBetween(0, 50),
            'order_status' => $this->faker->numberBetween(0, 3), // Example order status values
            'payment_status' => $this->faker->numberBetween(0, 1), // Example payment status values
            'payment_method' => $this->faker->numberBetween(1, 3), // Example payment method values
            'message' => $this->faker->sentence(),
        ];
    }
}

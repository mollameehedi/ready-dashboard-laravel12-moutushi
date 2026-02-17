<?php

namespace Database\Factories\Product;

use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->name();
        $category = Category::inRandomOrder()->first();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => $this->faker->randomElement([0, 1]),
            'category_id' => $category->id,
        ];
    }
}

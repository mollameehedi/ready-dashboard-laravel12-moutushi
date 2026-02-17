<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product\Category;
use App\Models\Product\SubCategory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $title = $this->faker->unique()->sentence();
        $category = Category::inRandomOrder()->first();
        $subCategory = SubCategory::inRandomOrder()->first();
        $user = User::inRandomOrder()->first(); // Get a random user

        return [
            'title' => $title,
            'product_code' => $this->faker->unique()->ean13(),
            'slug' => Str::slug($title),
            'short_description' => $this->faker->paragraph(),
            'long_description' => $this->faker->paragraph(5),
            'quantity' => $this->faker->numberBetween(0, 100),
            'alert_quantity' => $this->faker->numberBetween(0, 10),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'pre_price' => $this->faker->randomFloat(2, 10, 1000),
            'highlight' => $this->faker->numberBetween(1, 3),
            'is_active' => $this->faker->randomElement([0, 1]),
            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
            'models' => json_encode($this->faker->randomElements(['Model-1', 'Model-2', 'Model-3'], $this->faker->numberBetween(1, 3))),
            'colors' => json_encode($this->faker->randomElements(['Red', 'Blue', 'Green'], $this->faker->numberBetween(1, 3))),
            'sizes' => json_encode($this->faker->randomElements(['S', 'M', 'L', 'XL'], $this->faker->numberBetween(1, 3))),
            'meta_tag' => $this->faker->sentence(),
            'meta_title' => $this->faker->sentence(),
            'meta_description' => $this->faker->paragraph(),
            'created_by' => $user->id,
            'updated_by' => null,
        ];
    }
}

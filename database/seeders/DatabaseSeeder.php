<?php

namespace Database\Seeders;

use App\Models\Order\Order;
use App\Models\Order\OrderDetails;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            SettingSeeder::class,
        ]);

        User::factory()->count(10)->create();
        Category::factory()->count(10)->create();
        SubCategory::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Order::factory()->count(10)->create();
        OrderDetails::factory()->count(10)->create();
    }
}

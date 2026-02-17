<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;


class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settingsData = [
            ['name' => 'website_name', 'value' => 'website_name'],
            ['name' => 'website_description', 'value' => 'Your Runterminal Description'],
            ['name' => 'email', 'value' => 'your@runterminal.com'],
            ['name' => 'number', 'value' => '+1 123 456 7890'],
            ['name' => 'address', 'value' => 'Your School Address'],
            ['name' => 'footer_text', 'value' => 'Copyright 2024 Your Runterminal'],
            ['name' => 'outside_dhaka', 'value' => 130],
            ['name' => 'inside_dhaka', 'value' => 80],
            ['name' => 'shop_banner', 'value' => 'shop_banner'],
            ['name' => 'currency', 'value' => 'USD'],
            ['name' => 'currency_position', 'value' => 1], // 1 for left, 2 for right
            ['name' => 'website_logo', 'value' => 'website_logo'],
            ['name' => 'website_favicon', 'value' => 'website_favicon'],

            // Social Links
            ['name' => 'facebook_link', 'value' => ''],
            ['name' => 'twitter_link', 'value' => ''],
            ['name' => 'youtube_link', 'value' => ''],
            ['name' => 'instagram_link', 'value' => ''],
            // Meta Information
            ['name' => 'site_keywords', 'value' => 'product, education, learning'], // Example keywords
            ['name' => 'site_author', 'value' => 'Your Easy Ecommerce Name'],
        ];

        // Create settings efficiently using a loop
        foreach ($settingsData as $setting) {
            Setting::create($setting);
        }
    }
}

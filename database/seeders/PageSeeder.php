<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $about = "
        <h2>About</h2>
        <p>This is the updated about content.</p>
        <p>You can add more paragraphs or HTML content here.</p>
    ";
        $tarms_and_condition = "
        <h2>Terms and Conditions</h2>
        <p>This is the updated terms and conditions content.</p>
        <p>You can add more paragraphs or HTML content here.</p>
    ";
        $privacy_policy = "
        <h2>Privacy policy</h2>
        <p>This is the updated Privacy policy content.</p>
        <p>You can add more paragraphs or HTML content here.</p>
    ";
        $return_policy = "
        <h2>Return policy</h2>
        <p>This is the updated Return policy content.</p>
        <p>You can add more paragraphs or HTML content here.</p>
    ";
    Page::create([
        'name' => 'Terms and condition',
        'slug' => 'terms-and-condition',
        'description' => $tarms_and_condition
    ]);
    Page::create([
        'name' => 'About',
        'slug' => 'about',
        'description' => $about
    ]);

    Page::create([
        'name' => 'Privacy policy',
        'slug' => 'privacy-policy',
        'description' => $privacy_policy
    ]);
    Page::create([
        'name' => 'Return Policy',
        'slug' => 'return-policy',
        'description' => $privacy_policy
    ]);
    }
}

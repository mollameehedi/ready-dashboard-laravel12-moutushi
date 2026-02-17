<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

         // Inserting data directly in the migration (NOT RECOMMENDED)
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

        DB::table('pages')->insert([
            [
                'name' => 'Terms and condition',
                'slug' => 'terms-and-condition',
                'description' => $tarms_and_condition,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'About',
                'slug' => 'about',
                'description' => $about,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Privacy policy',
                'slug' => 'privacy-policy',
                'description' => $privacy_policy,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Return Policy',
                'slug' => 'return-policy',
                'description' => $return_policy,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

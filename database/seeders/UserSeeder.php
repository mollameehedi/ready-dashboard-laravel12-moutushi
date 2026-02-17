<?php

namespace Database\Seeders;

use App\Enums\Common\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => Role::Admin->value,
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'number' => '12345678900',
            'password' => bcrypt('password'),
        ]);

    }
}

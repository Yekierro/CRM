<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admiral',
            'email' => 'admin@example.com',
            'password' => bcrypt('11111111'),
            'role' => 'admin'
        ]);
    }
}

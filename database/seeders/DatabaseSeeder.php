<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Category::factory(20)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'hapsari123@gmail.com',
            'password' => bcrypt('hapsari123')
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Accommodation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Accommodation::query()->delete();
        Accommodation::factory()->count(100)->create();
        // User::query()->delete();
        User::factory()->count(100)->create();
    }
}

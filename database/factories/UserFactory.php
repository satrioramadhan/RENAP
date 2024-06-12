<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $faker = Faker::create('id_ID');

        return [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'), // you can set a default password
            'is_admin' => $faker->boolean(20), // 20% chance of being an admin
            'remember_token' => Str::random(10),
        ];
    }
}

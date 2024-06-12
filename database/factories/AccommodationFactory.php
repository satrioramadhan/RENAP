<?php
namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class AccommodationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accommodation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create('id_ID');
        return [
            'name' => $faker->company,
            'image_url' => $faker->imageUrl(),
            'address' => $faker->address,
            'rating' => $faker->randomFloat(1, 0, 5),
            'price' => $faker->numberBetween(50000, 2000000),
            'public_facilities' => $faker->numberBetween(1, 5),
            'name_facilities_public' => $faker->words(3, true),
            'facilities' => $faker->numberBetween(1, 5),
            'name_facilities' => $faker->words(3, true),
            'distance_to_city' => $faker->numberBetween(1, 10),
        ];
    }
}

<?php

namespace Database\Factories\Vendor;

use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'display_name'     => $this->faker->name,
            'contact_name'     => $this->faker->name,
            'email'            => $this->faker->unique()->email,
            'slug'             => $this->faker->unique()->word,
            'password'         => bcrypt('123456'),
            'contact'          => '1234567890',
            'popularity'       => $this->faker->numberBetween(20, 100)
        ];
    }
}

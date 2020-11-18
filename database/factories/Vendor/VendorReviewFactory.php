<?php

namespace Database\Factories\Vendor;

use App\Models\Vendor\VendorReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VendorReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating'                => $this->faker->numberBetween(1, 10),
            'comment'               => $this->faker->text,
            'customer_id'           => '1',
            'vendor_id'             => $this->faker->unique()->numberBetween(1, 18)
        ];
    }
}

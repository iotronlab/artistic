<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku'                   => $this->faker->slug,
            'type'                  => 'simple',
            'attribute_family_id'   => 1,
            'vendor_id'             => 1,
            'view_count'       => $this->faker->numberBetween(100, 1000),
            'popularity'            => $this->faker->numberBetween(20, 100),
        ];
    }
}

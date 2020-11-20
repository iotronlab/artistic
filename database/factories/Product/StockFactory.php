<?php

namespace Database\Factories\Product;

use App\Models\Product\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'             => $this->faker->unique()->numberBetween(1, 25),
            'quantity'            => $this->faker->numberBetween(50, 100),
        ];
    }
}

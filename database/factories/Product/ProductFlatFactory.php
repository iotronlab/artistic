<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductFlat;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFlatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductFlat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku'                   => $this->faker->slug,
            'name'                  => $this->faker->name,
            'description'           => $this->faker->text,
            'url_key'               => $this->faker->slug,
            'featured'              => $this->faker->boolean,
            //'status'                => $this->faker->boolean,
            'price'                 => $this->faker->numberBetween(100, 2000),
            'special_price'         => $this->faker->numberBetween(100, 2000),
            'short_description'     => $this->faker->name,
            'meta_title'            => $this->faker->jobTitle,
            // 'meta_keyword'         => $this->faker->catchPhrase,
            'width'                 => $this->faker->numberBetween(1, 20),
            'height'                => $this->faker->numberBetween(1, 80),
            'length'                 => $this->faker->numberBetween(10, 20),
            'weight'                => $this->faker->numberBetween(70, 100),
            'color'                 => $this->faker->numberBetween(1, 5),
            'size'                  => $this->faker->numberBetween(6, 9),
            'material'              => $this->faker->numberBetween(10, 17),
            'medium'                => $this->faker->numberBetween(18, 19),
            'visible_individually'  => $this->faker->boolean,
            'product_id'            => Product::factory(),
        ];
    }
}

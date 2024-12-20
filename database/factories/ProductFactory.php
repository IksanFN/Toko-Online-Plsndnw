<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

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
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'thumbnail' => $this->faker->word(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'sku' => $this->faker->word(),
            'price' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
        ];
    }
}

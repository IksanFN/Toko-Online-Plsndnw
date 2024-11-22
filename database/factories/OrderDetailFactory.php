<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Transaction;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::factory(),
            'product_id' => Product::factory(),
            'qty' => $this->faker->numberBetween(-10000, 10000),
            'price' => $this->faker->numberBetween(-100000, 100000),
            'subtotal' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}

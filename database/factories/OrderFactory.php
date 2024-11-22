<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->word(),
            'user_id' => User::factory(),
            'discount' => $this->faker->numberBetween(-10000, 10000),
            'total' => $this->faker->numberBetween(-10000, 10000),
            'profit' => $this->faker->numberBetween(-10000, 10000),
            'order_status' => $this->faker->word(),
            'payment_status' => $this->faker->word(),
            'payment_date' => $this->faker->dateTime(),
            'order_date' => $this->faker->dateTime(),
            'payment_method' => $this->faker->word(),
        ];
    }
}

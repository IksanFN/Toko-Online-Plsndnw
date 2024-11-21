<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Models\User;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'transaction_code' => $this->faker->word(),
            'user_id' => User::factory(),
            'total_amount' => $this->faker->numberBetween(-100000, 100000),
            'transaction_status' => $this->faker->word(),
            'payment_status' => $this->faker->word(),
            'payment_date' => $this->faker->dateTime(),
            'order_date' => $this->faker->dateTime(),
            'payment_method' => $this->faker->word(),
        ];
    }
}

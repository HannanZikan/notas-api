<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        return [
            'user_id'      => $user->id,
            'order_number' => $this->faker->unique()->numerify('#########'),
            'amount'       => $this->faker->randomFloat(2, 10, 1000),
            'issue_date'   => $this->faker->date,
            'sender_cnpj'  => $this->faker->numerify('########0001'),
            'sender_name'  => $this->faker->company,
            'carrier_cnpj' => $this->faker->numerify('########0001'),
            'carrier_name' => $this->faker->company,

        ];
    }
}

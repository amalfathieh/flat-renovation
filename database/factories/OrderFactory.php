<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => User::factory(),
            'company_id' => Company::factory(),
            'status' => 'accepted',
            'cost_of_examination' => $this->faker->randomFloat(2, 10, 200),
            'location' => $this->faker->address,
            'budget' => $this->faker->randomFloat(2, 1000, 5000),
        ];
    }
}

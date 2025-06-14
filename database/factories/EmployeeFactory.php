<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = $this->faker->unique()->company();
        return [
            'user_id' => User::factory()->withEmployeeRole(),
            'company_id' => fake()->numberBetween(1, 4),
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "gender" => fake()->randomElement(['male', 'female']),
            "phone" => fake()->phoneNumber(),
            "starting_date" => fake()->date(),
            "birth_day" => fake()->date(),
            ];

    }
}

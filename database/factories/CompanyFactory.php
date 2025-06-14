<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->company();
        return [
            'user_id' => User::factory()->withCompanyRole(),
            'name' => $name,
            'slug' => Str::slug($name),
            "email" => fake()->email(),
            "location" => fake()->address(),
            "phone" => fake()->phoneNumber(),
            "about" => $this->faker->paragraph(),
            'logo' => $this->faker->imageUrl(640, 480, 'business'), // صورة وهمية
        ];
    }
}

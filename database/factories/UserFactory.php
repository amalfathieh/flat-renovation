<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName('male') . ' ' . $this->faker->lastName . ' ' . $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'payment_phone' => '09' . $this->faker->numberBetween(1, 9) . $this->faker->randomNumber(7, true),
            'balance' => 0,
            'remember_token' => Str::random(10),
        ];

    }

//    public function configure()
//    {
//        return $this->afterCreating(function (User $user){
//            $user->assignRole('company');
//        });
//    }

    public function withRole(string $roleName){
        return $this->afterCreating(function (User $user)
        use ($roleName) {
            $user->assignRole($roleName);
        });
    }

    public function withCompanyRole() {
        return $this->afterCreating(function (User $user){
            $user->assignRole('company');
        });
    }

    public function withEmployeeRole() {
        return $this->afterCreating(function (User $user){
            $user->assignRole('employee');
        });
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

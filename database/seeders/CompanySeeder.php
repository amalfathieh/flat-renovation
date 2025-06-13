<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
       User::factory()->count(3)->create()->each(function ($user) {
            Company::create([
                'user_id' => $user->id,
                'name' => fake()->company,
                'slug' => fake()->slug,
                'email' => fake()->companyEmail,
                'location' => fake()->address,
                'phone' => fake()->phoneNumber,
                'about' => fake()->paragraph,
                'logo' => fake()->imageUrl(200, 200, 'business', true, 'logo'),
            ]);
        });
    }
}

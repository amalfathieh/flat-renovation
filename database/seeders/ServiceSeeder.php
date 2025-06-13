<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company) {
            for ($i = 0; $i < 3; $i++) {
                Service::create([
                    'company_id' => $company->id,
                    'name' => fake()->bs,
                    'description' => fake()->sentence,
                    'image' => fake()->imageUrl(640, 480, 'service', true, 'service'),
                ]);
            }
        });
    }
}

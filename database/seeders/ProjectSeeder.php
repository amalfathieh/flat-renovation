<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company) {
            for ($i = 0; $i < 2; $i++) {
                Project::create([
                    'company_id' => $company->id,
                    'name' => fake()->catchPhrase,
                    'description' => fake()->paragraph,
                ]);
            }
        });
    }
}

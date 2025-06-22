<?php

namespace Database\Seeders;

use App\Models\ProjectRating;
use Illuminate\Database\Seeder;

class ProjectRatingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ProjectSeeder::$projects as $key => $project) {
            for ($r = 1; $r <= 4; $r++) {
                ProjectRating::create([
                    'project_id' => $project->id,
                    'customer_id' => 1,
                    'rating' => random_int(1, 5),
                ]);
            }
        }
    }
}

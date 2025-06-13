<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    public function run(): void
    {
        Project::all()->each(function ($project) {
            for ($i = 0; $i < 3; $i++) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_url' => fake()->imageUrl(640, 480, 'projects', true, 'project'),
                    'caption' => fake()->sentence(3),
                ]);
            }
        });
    }
}

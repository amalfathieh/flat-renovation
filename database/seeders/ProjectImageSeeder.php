<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    public function run(): void
    {
        foreach (ProjectSeeder::$projects as $projectIndex => $project) {
            for ($img = 1; $img <= 4; $img++) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'before_image' => "project-images/before_{$projectIndex}_{$img}.jpg",
                    'after_image' => "project-images/after_{$projectIndex}_{$img}.jpg",
                    'caption' => "صورة $img قبل وبعد (مشروع رقم $projectIndex)",
                ]);
            }
        }
    }
}

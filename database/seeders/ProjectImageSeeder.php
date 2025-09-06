<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    public function run(): void
    {

        $projects = Project::take(5)->get();

        $imageIndex = 1;

        foreach ($projects as $projectIndex => $project) {

            for ($i = 1; $i <= 4; $i++) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'before_image' => "project-images/before_{$imageIndex}.png",
                    'after_image'  => "project-images/after_{$imageIndex}.png",
                    'caption' => "صورة $i قبل وبعد (مشروع رقم " . ($projectIndex + 1) . ")",
                ]);

                $imageIndex++;
            }
        }
    }
}

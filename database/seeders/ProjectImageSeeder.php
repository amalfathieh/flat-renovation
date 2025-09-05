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
                    'before_image' => "storage/project-images/before_{$imageIndex}.jpg",
                    'after_image'  => "storage/project-images/after_{$imageIndex}.jpg",
                    'caption' => "صورة $i قبل وبعد (مشروع رقم " . ($projectIndex + 1) . ")",
                ]);

                $imageIndex++;
            }
        }
    }
}

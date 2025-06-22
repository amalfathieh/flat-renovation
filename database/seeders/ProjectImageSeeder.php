<?php

namespace Database\Seeders;

use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{

    public function run(): void
    {

        foreach (ProjectSeeder::$projects as $key => $project) {
            for ($img = 1; $img <= 4; $img++) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'before_image' => "before$img.jpg",
                    'after_image' => "after$img.jpg",
                    'caption' => "صورة $img قبل وبعد",
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            for ($i = 1; $i <= 3; $i++) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'before_image' => 'companies-logo/before' . $i . '.jpg',
                    'after_image' => 'companies-logo/after' . $i . '.jpg',
                    'caption' => 'صورة رقم ' . $i . ' لمشروع ' . $project->project_name,
                ]);
            }
        }
    }
}

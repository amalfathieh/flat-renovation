<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $project = Project::first();

        ProjectImage::create([
            'project_id' => $project->id,
            'before_image' => 'before1.jpg',
            'after_image' => 'after1.jpg',
            'caption' => 'صورة المشروع قبل وبعد التنفيذ',
        ]);



    }
}

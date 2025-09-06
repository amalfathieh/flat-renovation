<?php

namespace Database\Seeders;

use App\Models\Image_stage;
use App\Models\ProjectStage;
use Illuminate\Database\Seeder;

class ProjectStageImageSeeder extends Seeder
{
    public function run(): void
    {

        $imageIndex = 1;

        $stages = ProjectStage::orderBy('id')->take(20)->get();

        foreach ($stages as $stage) {

            for ($i = 1; $i <= 4; $i++) {
                Image_stage::create([
                    'project_stage_id' => $stage->id,
                    'image' => "project-stage-images/{$imageIndex}.jpg",
                ]);

                $imageIndex++;
            }
        }
    }
}

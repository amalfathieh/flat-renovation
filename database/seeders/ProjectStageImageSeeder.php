<?php

namespace Database\Seeders;

use App\Models\Image_stage;
use Illuminate\Database\Seeder;

class ProjectStageImageSeeder extends Seeder
{
    public function run(): void
    {

        $imageIndex = 1;


        $stages = array_slice(StageSeeder::$stages, 0, 2 * 4);


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

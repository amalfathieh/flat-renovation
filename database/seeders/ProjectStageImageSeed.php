<?php

namespace Database\Seeders;

use App\Models\Image_stage;
use Illuminate\Database\Seeder;

class ProjectStageImageSeed extends Seeder
{
    public function run(): void
    {
        foreach (StageSeeder::$stages as $key => $stage) {
            for ($img = 1; $img <= 4; $img++) {
                Image_stage::create([
                    'project_stage_id' => $stage->id,
                    'image' => "project-stage-images/{$key}_{$img}.jpg", // ← اسم صورة فريد
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProjectStage;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service = Service::first();
        $serviceTypes = $service->serviceTypes;
        foreach ($serviceTypes as $serviceType){
            foreach (ProjectSeeder::$projects as $key => $project) {

                ProjectStage::create([
                    'project_id' => $project->id,
                    'stage_name' => "Stage Name",
                    "service_id" => $service->id,
                    "service_type_id" => $serviceType->id,
                    "description" => "description mnjyidus",
                    'cost' => 200,
                ]);
            }
        }
    }
}

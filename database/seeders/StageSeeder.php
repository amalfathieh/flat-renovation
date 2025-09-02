<?php

namespace Database\Seeders;

use App\Models\ProjectStage;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    public static array $stages = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service = Service::first();
        $serviceTypes = $service->serviceTypes;
        foreach ($serviceTypes as $serviceType){
            foreach (ProjectSeeder::$projects as $key => $project) {

                self::$stages[$key] = ProjectStage::create([
                    'project_id' => $project->id,
                    'name' => "مرحلة: ". $service->name,
                    "service_id" => $service->id,
                    "service_type_id" => $serviceType->id,
                    "description" => "بالنسبة ". $service->name . " سيتم " .$serviceType->description,
                    'cost' => 200,
                ]);
            }
        }
    }
}

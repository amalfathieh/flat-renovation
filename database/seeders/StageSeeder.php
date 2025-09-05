<?php

namespace Database\Seeders;

use App\Models\ProjectStage;
use App\Models\Service;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    public static array $stages = [];

    public function run(): void
    {
        $services = Service::all();


        $projects = array_slice(ProjectSeeder::$projects, 0, 10, true);

        foreach ($projects as $projectKey => $project) {


            $projectServices = $services->take(4);

            foreach ($projectServices as $index => $service) {


                $serviceType = $service->serviceTypes->first();

                if (!$serviceType) continue;

                $stage = ProjectStage::create([
                    'project_id' => $project->id,
                    'name' => "مرحلة " . ($index + 1) . ": {$service->name}",
                    'service_id' => $service->id,
                    'service_type_id' => $serviceType->id,
                    'description' => "هذه المرحلة تتعلق بخدمة {$service->name} ونوعها {$serviceType->description}",
                    'cost' => rand(100, 500),
                ]);


                self::$stages["{$projectKey}-{$index}"] = $stage;
            }
        }
    }
}

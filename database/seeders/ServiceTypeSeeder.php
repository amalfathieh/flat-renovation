<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    public function run(): void
    {



        $typesPerService = [
            'أرضيات' => [
                ['name' => 'سيراميك', 'description' => 'تركيب أرضيات سيراميك', 'unit' => 'متر مربع', 'price' => 5000, 'image' => 'ceramic.png'],
                ['name' => 'باركيه', 'description' => 'تركيب أرضيات باركيه', 'unit' => 'متر مربع', 'price' => 7000, 'image' => 'parquet.png'],
                ['name' => 'رخام', 'description' => 'تركيب أرضيات رخام', 'unit' => 'متر مربع', 'price' => 15000, 'image' => 'marble.png'],
            ],
            'دهان' => [
                ['name' => 'دهان زيتي', 'description' => 'دهان زيتي للجدران', 'unit' => 'متر مربع', 'price' => 3000, 'image' => 'oil_paint.png'],
                ['name' => 'دهان بلاستيك', 'description' => 'دهان بلاستيك للأسقف والجدران', 'unit' => 'متر مربع', 'price' => 2500, 'image' => 'plastic_paint.png'],
                ['name' => 'دهان مقاوم للرطوبة', 'description' => 'دهان خاص للحمامات والمطابخ', 'unit' => 'متر مربع', 'price' => 4000, 'image' => 'moisture_paint.png'],
            ],
            'تمديدات صحية' => [
                ['name' => 'أنابيب PPR', 'description' => 'بوري بلاستيكي PPR مقاوم للحرارة', 'unit' => 'متر طولي', 'price' => 2500, 'image' => 'ppr_pipe.png'],
                ['name' => 'أنابيب PVC', 'description' => 'بوري بلاستيكي PVC مقاوم للضغط', 'unit' => 'متر طولي', 'price' => 2000, 'image' => 'pvc_pipe.png'],
                ['name' => 'أنابيب نحاس', 'description' => 'بوري نحاسي عالي الجودة', 'unit' => 'متر طولي', 'price' => 5000, 'image' => 'copper_pipe.png'],
            ],
            'كهرباء' => [

                ['name' => 'سلك نحاسي 1.5 مم²', 'description' => 'سلك نحاسي للاستخدام في الإضاءة والأحمال الخفيفة', 'unit' => 'متر طولي', 'price' => 1500, 'image' => 'cable_1.5mm.png'],
                ['name' => 'سلك نحاسي 2.5 مم²', 'description' => 'سلك نحاسي للأحمال المتوسطة مثل المقابس الكهربائية', 'unit' => 'متر طولي', 'price' => 2000, 'image' => 'cable_2.5mm.png'],
                ['name' => 'سلك نحاسي 4 مم²', 'description' => 'سلك نحاسي للأحمال العالية مثل المكيفات', 'unit' => 'متر طولي', 'price' => 3000, 'image' => 'cable_4mm.png'],
            ],
        ];

        foreach ($typesPerService as $serviceName => $types) {
            $service = Service::where('name', $serviceName)->first();

            if (!$service) continue;

            foreach ($types as $type) {
                ServiceType::create([
                    'service_id' => $service->id,
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'unit' => $type['unit'],
                    'price_per_unit' => $type['price'],
                    'image' => $type['image'],
                ]);

                }
    }







        }
}

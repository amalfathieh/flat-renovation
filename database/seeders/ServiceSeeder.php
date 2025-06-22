<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'أرضيات',
                'description' => 'خدمة تركيب الأرضيات',
                'image' => 'companies-logo/service1.png',
                'types' => [
                    ['name' => 'دهان زيتي', 'unit' => 'متر مربع', 'price_per_unit' => 15],
                    ['name' => 'دهان مائي', 'unit' => 'متر مربع', 'price_per_unit' => 10],
                ]
            ],
            [
                'name' => 'دهان',
                'description' => 'خدمة دهان الجدران والأسقف',
                'image' => 'companies-logo/service2.jpg',
                'types' => [
                    ['name' => 'دهان زيتي', 'unit' => 'متر مربع', 'price_per_unit' => 15],
                    ['name' => 'دهان مائي', 'unit' => 'متر مربع', 'price_per_unit' => 10],
                ]
            ],
            [
                'name' => 'تمديدات صحية',
                'description' => 'خدمة التمديدات الصحية للحمامات والمطابخ',
                'image' => 'companies-logo/service3.jpg',
                'types' => [
                    ['name' => 'تمديدات داخلية', 'unit' => 'متر مربع', 'price_per_unit' => 15],
                    ['name' => 'تمديدات خارجية', 'unit' => 'متر مربع', 'price_per_unit' => 10],
                ]
            ],
            [
                'name' => 'كهرباء',
                'description' => 'خدمة التمديدات الكهربائية',
                'image' => 'companies-logo/after2.jpg',
                'types' => [
                    ['name' => 'نقاط إضاءة', 'unit' => 'قطعة', 'price_per_unit' => 30],
                    ['name' => 'مفاتيح', 'unit' => 'قطعة', 'price_per_unit' => 20],
                ]
            ],
            [
                'name' => 'نجارة',
                'description' => 'خدمة أعمال النجارة الداخلية والخارجية',
                'image' => 'companies-logo/service4.jpg',
                'types' => [
                    ['name' => 'نقاط إضاءة', 'unit' => 'قطعة', 'price_per_unit' => 30],
                    ['name' => 'مفاتيح', 'unit' => 'قطعة', 'price_per_unit' => 20],
                ]
            ],
            [
                'name' => 'ديكور',
                'description' => 'تصميم وتنفيذ الديكورات الحديثة',
                'image' => 'companies-logo/service5.jpg',
                'types' => [
                    ['name' => 'نقاط إضاءة', 'unit' => 'قطعة', 'price_per_unit' => 30],
                    ['name' => 'مفاتيح', 'unit' => 'قطعة', 'price_per_unit' => 20],
                ]
            ],
        ];

        $companies = Company::all();

        foreach ($companies as $company) {
            foreach ($services as $service) {

                $se = Service::create([
                    'company_id' => $company->id,
                    'name' => $service['name'],
                    'description' => $service['description'],
                    'image' => $service['image'],
                ]);

                foreach ($service['types'] as $type) {
                    ServiceType::create([
                        'service_id' => $se->id,
                        'name' => $type['name'],
                        'description' => 'وصف لنوع ' . $type['name'],
                        'unit' => $type['unit'],
                        'price_per_unit' => $type['price_per_unit'],
                    ]);
                }
            }
        }
    }
}

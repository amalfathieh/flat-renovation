<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'أرضيات', 'description' => 'خدمة تركيب الأرضيات', 'image' => 'companies-logo/service1.png'],
            ['name' => 'دهان', 'description' => 'خدمة دهان الجدران والأسقف', 'image' => 'companies-logo/service2.jpg'],
            ['name' => 'تمديدات صحية', 'description' => 'خدمة التمديدات الصحية للحمامات والمطابخ', 'image' => 'companies-logo/service3.jpg'],
            ['name' => 'كهرباء', 'description' => 'خدمة التمديدات الكهربائية', 'image' => 'companies-logo/after2.jpg'],
            ['name' => 'نجارة', 'description' => 'خدمة أعمال النجارة الداخلية والخارجية', 'image' => 'companies-logo/service4.jpg'],
            ['name' => 'ديكور', 'description' => 'تصميم وتنفيذ الديكورات الحديثة', 'image' => 'companies-logo/service5.jpg'],
        ];

        $companies = Company::all();

        foreach ($companies as $company) {
            foreach ($services as $service) {
                Service::create([
                    'company_id' => $company->id,
                    'name' => $service['name'],
                    'description' => $service['description'],
                    'image' => $service['image'],
                ]);
            }
        }
    }
}

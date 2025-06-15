<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $company = Company::first();

        $services = [
            ['name' => 'أرضيات', 'description' => 'خدمة تركيب الأرضيات', 'image' => 'flooring.png'],
            ['name' => 'دهان', 'description' => 'خدمة دهان الجدران والأسقف', 'image' => 'painting.png'],
            ['name' => 'تمديدات صحية', 'description' => 'خدمة التمديدات الصحية للحمامات والمطابخ', 'image' => 'plumbing.png'],
            ['name' => 'كهرباء', 'description' => 'خدمة التمديدات الكهربائية', 'image' => 'electricity.png'],
        ];

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

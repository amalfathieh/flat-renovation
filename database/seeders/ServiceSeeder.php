<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\QuestionService;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{

    public function run(): void
    {

        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->warn('لا توجد شركات لإضافة الخدمات لها.');
            return;
        }

        $services = [
            [
                'name' => 'أرضيات',
                'description' => 'خدمة تركيب الأرضيات',
                'image' => 'flooring.png',
                'questions' => [
                    'ما نوع الأرضية التي تريد تركيبها؟',
                    'ما هي مساحة الأرض المطلوب تغطيتها (بالمتر المربع)؟',
                    'هل تحتاج إلى إزالة الأرضية القديمة؟',
                ],
            ],
            [
                'name' => 'دهان',
                'description' => 'خدمة دهان الجدران والأسقف',
                'image' => 'painting.png',
                'questions' => [
                    'ما نوع الطلاء المطلوب استخدامه؟',
                    'ما مساحة الجدران المطلوب تغطيتها بالطلاء (بالمتر المربع )؟',
                    'هل تحتاج إلى إزالة الطلاء القديم؟',
                ],
            ],
            [
                'name' => 'تمديدات صحية',
                'description' => 'خدمة التمديدات الصحية للحمامات والمطابخ',
                'image' => 'plumbing.png',
                'questions' => [
                    'ما نوع الأنابيب التي تريد استخدامها ؟',
                    'ما هو الطول التقريبي المطلوب لتمديدات الصحية (بالمتر)؟',
                    'هل هناك تمديدات قديمة يجب إزالتها؟',
                ],
            ],
            [
                'name' => 'كهرباء',
                'description' => 'خدمة التمديدات الكهربائية',
                'image' => 'electricity.png',
                'questions' => [
                    'ما نوع الأسلاك الكهربائية التي ترغب في تركيبها؟',
                    'ما هو الطول التقريبي المطلوب لتمديدات الكهرباء (بالمتر)؟',
                    'هل الموقع مزود بلوحة توزيع كهربائية رئيسية؟',
                ],
            ],
        ];

        foreach ($companies as $company) {
            foreach ($services as $serviceData) {
                $service = Service::create([
                    'company_id' => $company->id,
                    'name' => $serviceData['name'],
                    'description' => $serviceData['description'],
                    'image' => $serviceData['image'],
                ]);

                foreach ($serviceData['questions'] as $question) {
                    QuestionService::create([
                        'service_id' => $service->id,
                        'question' => $question,
                'has_options' => str_starts_with($question, 'ما نوع'),
                    ]);
                }

            }


        }

    }



}

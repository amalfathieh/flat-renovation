<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\QuestionService;
use App\Models\Service;
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


        $baseServices = [
            'أرضيات',
            'دهان',
            'تمديدات صحية',
            'كهرباء',
        ];

        $baseImages = [
            'flooring',
            'painting',
            'plumbing',
            'electricity',
        ];

        $baseDescriptions = [
            'خدمة تركيب الأرضيات',
            'خدمة دهان الجدران والأسقف',
            'خدمة التمديدات الصحية للحمامات والمطابخ',
            'خدمة التمديدات الكهربائية',
        ];

        $questionsMap = [
            'أرضيات' => [
                'ما نوع الأرضية التي تريد تركيبها؟',
                'ما هي مساحة الأرض المطلوب تغطيتها (بالمتر المربع)؟',
                'هل تحتاج إلى إزالة الأرضية القديمة؟',
            ],
            'دهان' => [
                'ما نوع الطلاء المطلوب استخدامه؟',
                'ما مساحة الجدران المطلوب تغطيتها بالطلاء (بالمتر المربع )؟',
                'هل تحتاج إلى إزالة الطلاء القديم؟',
            ],
            'تمديدات صحية' => [
                'ما نوع الأنابيب التي تريد استخدامها ؟',
                'ما هو الطول التقريبي المطلوب لتمديدات الصحية (بالمتر)؟',
                'هل هناك تمديدات قديمة يجب إزالتها؟',
            ],
            'كهرباء' => [
                'ما نوع الأسلاك الكهربائية التي ترغب في تركيبها؟',
                'ما هو الطول التقريبي المطلوب لتمديدات الكهرباء (بالمتر)؟',
                'هل الموقع مزود بلوحة توزيع كهربائية رئيسية؟',
            ],
        ];

        foreach ($companies as $companyIndex => $company) {
            foreach ($baseServices as $index => $name) {
                $description = $baseDescriptions[$index] . ' خاصة بـ ' . $company->name;
                $image = "service-images/" . $baseImages[$index] . $companyIndex . ".png";

                $service = Service::create([
                    'company_id' => $company->id,
                    'name' => $name,
                    'description' => $description,
                    'image' => $image,
                ]);

                foreach ($questionsMap[$name] as $question) {
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

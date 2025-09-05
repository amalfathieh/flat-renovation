<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanyDataSeeder extends Seeder
{
    public static array $companies = [];

    public function run(): void
    {




        $companiesData = [
            [
                'name' => 'شركة إعمار سوريا للمقاولات',
                'slug' => Str::slug('شركة إعمار سوريا للمقاولات'),
                'location' => 'دمشق - أبو رمانة',
                'phone' => '011-3344556',
                'about' => 'متخصصة في خدمات الدهان، الكهرباء، التمديدات الصحية، والأرضيات بجودة عالية ومعايير أمان صارمة.',

                'logo' => 'companies-logo/logo1.png',

                'cost_of_examination' => 5000,
            ],
            [
                'name' => 'شركة البناء الحديث',
                'slug' => Str::slug('شركة البناء الحديث'),
                'location' => 'دمشق - المزة',
                'phone' => '011-2233445',
                'about' => 'تقدم حلول شاملة لأعمال الدهان والكهرباء والتمديدات الصحية وتركيب الأرضيات.',

                'logo' => 'companies-logo/logo2.png',

                'cost_of_examination' => 3000,
            ],
            [
                'name' => 'شركة الشام للهندسة والديكور',
                'slug' => Str::slug('شركة الشام للهندسة والديكور'),
                'location' => 'دمشق - جرمانا',
                'phone' => '0999554433',
                'about' => 'تتخصص في إعادة تأهيل الشقق عبر خدمات الدهان والكهرباء والتمديدات الصحية والأرضيات.',

                'logo' => 'companies-logo/logo3.png',

                'cost_of_examination' => 2000,
            ],
            [
                'name' => 'شركة الأمان للخدمات الهندسية',
                'slug' => Str::slug('شركة الأمان للخدمات الهندسية'),
                'location' => 'حلب - العزيزية',
                'phone' => '021-5544332',
                'about' => 'خبراء في أعمال الكهرباء، الدهان، التمديدات الصحية، والأرضيات مع ضمان الجودة.',

                'logo' => 'companies-logo/logo4.png',


                'cost_of_examination' => 2500,
            ],
            [
                'name' => 'شركة لمسة فن للبناء والديكور',
                'slug' => Str::slug('شركة لمسة فن للبناء والديكور'),
                'location' => 'دمشق - شارع بغداد',
                'phone' => '0933445566',
                'about' => 'فريق متخصص في جميع أعمال الدهان والكهرباء والتمديدات الصحية والأرضيات.',
                'logo' => 'companies-logo/logo5.png',

                'cost_of_examination' => 4000,
            ],
        ];

        foreach ($companiesData as $c => $data) {
            self::$companies[$c] = Company::create(array_merge($data, [
                'user_id' => \Database\Seeders\UserSeeder::$owners[$c]->id,
            ]));
        }








    }
}

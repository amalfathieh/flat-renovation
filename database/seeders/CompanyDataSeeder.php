<?php
//
//namespace Database\Seeders;
//
//use App\Models\User;
//use App\Models\Company;
//use Illuminate\Database\Seeder;
//use Illuminate\Support\Str;
//
//class CompanyDataSeeder extends Seeder
//{
//    public function run(): void
//    {
//        $ownerUser = User::where('email', 'owner@example.com')->first();
//
//        $companies = [
//            [
//                'name' => 'Test Company',
//                'location' => 'Damascus',
//                'phone' => '0999888777',
//                'about' => 'شركة وهمية لاختبار API.',
//                'logo' => 'companies-logo/logo.png',
//            ],
//            [
//                'name' => 'Alpha Solutions',
//                'location' => 'Aleppo',
//                'phone' => '0988123456',
//                'about' => 'شركة تقنية تقدم حلولاً برمجية.',
//                'logo' => 'companies-logo/alpha.png',
//            ],
//            [
//                'name' => 'Beta Marketing',
//                'location' => 'Homs',
//                'phone' => '0933445566',
//                'about' => 'متخصصة في التسويق الرقمي.',
//                'logo' => 'companies-logo/beta.png',
//            ],
//            [
//                'name' => 'Gamma Constructions',
//                'location' => 'Latakia',
//                'phone' => '0944556677',
//                'about' => 'شركة بناء وتشييد حديثة.',
//                'logo' => 'companies-logo/gamma.png',
//            ],
//            [
//                'name' => 'Delta Logistics',
//                'location' => 'Tartous',
//                'phone' => '0955667788',
//                'about' => 'خدمات لوجستية وشحن.',
//                'logo' => 'companies-logo/delta.png',
//            ],
//        ];
//
//        foreach ($companies as $company) {
//            Company::create([
//                'user_id' => $ownerUser->id,
//                'name' => $company['name'],
//                'slug' => Str::slug($company['name']),
//                'location' => $company['location'],
//                'phone' => $company['phone'],
//                'about' => $company['about'],
//                'logo' => $company['logo'],
//            ]);
//        }
//    }
//}


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{User, Company, Customer, Employee, Order, Project, ProjectImage, Service};

class CompanyDataSeeder extends Seeder
{
    public function run(): void
    {
        for ($c = 1; $c <= 5; $c++) {
            // مالك الشركة
            $ownerUser = User::factory()->create([
                'name' => "مالك $c",
                'email' => "owner{$c}_" . uniqid() . "@example.com",
            ]);

            $company = Company::create([
                'user_id' => $ownerUser->id,
                'name' => "شركة $c",
                'slug' => Str::slug("شركة $c"),
                'location' => 'دمشق',
                'phone' => "09999$c$c$c$c",
                'about' => 'شركة لأغراض الاختبار',
                'logo' => 'companies-logo/logo.png',
            ]);

            // خدمات الشركة
            for ($s = 1; $s <= 3; $s++) {
                Service::create([
                    'company_id' => $company->id,
                    'name' => "خدمة $s من شركة $c",
                    'description' => "وصف خدمة $s من شركة $c",
                    'image' => "companies-logo/service$s.png",
                ]);
            }

            // موظفين
            for ($e = 1; $e <= 2; $e++) {
                $employeeUser = User::factory()->create([
                    'name' => "موظف $e في شركة $c",
                    'email' => "employee{$c}_{$e}_" . uniqid() . "@example.com",
                ]);

                $employee = Employee::factory()->create([
                    'user_id' => $employeeUser->id,
                    'company_id' => $company->id,
                    'first_name' => "موظف $e",
                    'last_name' => "شركة $c",
                ]);

                // زبائن ومشاريعهم
                for ($z = 1; $z <= 2; $z++) {
                    $customerUser = User::factory()->create([
                        'name' => "زبون $z لشركة $c",
                        'email' => "customer{$c}_{$z}_" . uniqid() . "@example.com",
                    ]);

                    $customer = Customer::factory()->create([
                        'user_id' => $customerUser->id,
                    ]);

                    $order = Order::create([
                        'customer_id' => $customer->id,
                        'company_id' => $company->id,
                        'status' => 'accepted',
                        'cost_of_examination' => rand(50, 200),
                        'location' => 'دمشق',
                        'budget' => rand(1000, 5000),
                    ]);

                    $project = Project::create([
                        'company_id' => $company->id,
                        'order_id' => $order->id,
                        'employee_id' => $employee->id,
                        'project_name' => "مشروع زبون $z لشركة $c",
                        'start_date' => now()->subDays(rand(10, 60)),
                        'end_date' => now(),
                        'status' => 'finished',
                        'description' => 'تفاصيل المشروع',
                        'final_cost' => rand(1500, 6000),
                        'rate' => rand(1, 5),
                        'comment' => 'تعليق جيد',
                    ]);

                    // صور المشروع (4 صور)
                    for ($img = 1; $img <= 4; $img++) {
                        ProjectImage::create([
                            'project_id' => $project->id,
                            'before_image' => "companies-logo/before$img.jpg",
                            'after_image' => "companies-logo/after$img.jpg",
                            'caption' => "صورة $img قبل وبعد",
                        ]);
                    }
                }
            }
        }
    }
}

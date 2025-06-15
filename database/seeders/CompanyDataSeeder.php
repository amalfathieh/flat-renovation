<?php

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
                'logo' => 'logo.png',
            ]);

            // خدمات الشركة
            for ($s = 1; $s <= 3; $s++) {
                Service::create([
                    'company_id' => $company->id,
                    'name' => "خدمة $s من شركة $c",
                    'description' => "وصف خدمة $s من شركة $c",
                    'image' => "service$s.png",
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
                            'before_image' => "before$img.jpg",
                            'after_image' => "after$img.jpg",
                            'caption' => "صورة $img قبل وبعد",
                        ]);
                    }
                }
            }
        }
    }
}

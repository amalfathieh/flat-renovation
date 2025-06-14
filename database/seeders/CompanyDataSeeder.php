<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Service;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Order;
use App\Models\Employee;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanyDataSeeder extends Seeder
{
    public function run(): void
    {
        // زبون مع يوزر
        $customerUser = User::factory()->create([
            'name' => 'اسم الزبون',
            'email' => 'customer@example.com',
        ]);

        $customer = Customer::factory()->create([
            'user_id' => $customerUser->id,
        ]);

        // مستخدم مالك شركة
        $ownerUser = User::factory()->create([
            'name' => 'Test Owner',
            'email' => 'owner@example.com',
        ]);

        // شركة
        $company = Company::create([
            'user_id' => $ownerUser->id,
            'name' => 'Test Company',
            'slug' => Str::slug('Test Company'),
            'location' => 'Damascus',
            'phone' => '0999888777',
            'about' => 'شركة وهمية لاختبار API.',
            'logo' => 'logo.png', // فقط الاسم
        ]);

        // خدمات
        for ($i = 1; $i <= 3; $i++) {
            Service::create([
                'company_id' => $company->id,
                'name' => "خدمة $i",
                'description' => "وصف الخدمة $i",
                'image' => "service$i.png", // فقط الاسم
            ]);
        }

        // مستخدم موظف
        $employeeUser = User::factory()->create([
            'name' => 'الموظف الأول',
            'email' => 'employee@example.com',
        ]);

        // موظف
        $employee = Employee::factory()->create([
            'user_id' => $employeeUser->id,
            'company_id' => $company->id,
            'first_name' => 'الموظف',
            'last_name' => 'الأول',
        ]);

        // طلب
        $order = Order::create([
            'customer_id' => $customer->id,
            'company_id' => $company->id,
            'status' => 'accepted',
            'cost_of_examination' => 100.00,
            'location' => 'دمشق',
            'budget' => 3000.00,
        ]);

        // مشروع
        $project = Project::create([
            'company_id' => $company->id,
            'order_id' => $order->id,
            'employee_id' => $employee->id,
            'project_name' => 'مشروع تجريبي',
            'start_date' => now()->subDays(30),
            'end_date' => now(),
            'status' => 'finished',
            'description' => 'تفاصيل المشروع التجريبي',
            'final_cost' => 5000.00,
            'rate' => 4,
            'comment' => 'ممتاز',
        ]);

        // صور المشروع
        ProjectImage::create([
            'project_id' => $project->id,
            'before_image' => 'before1.jpg', // فقط الاسم
            'after_image' => 'after1.jpg',   // فقط الاسم
            'caption' => 'صورة المشروع قبل وبعد التنفيذ',
        ]);
    }
}

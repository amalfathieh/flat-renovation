<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['finished', 'In progress', 'Preparing'];
        $companies = Company::all();

        foreach ($companies as $company) {
            // جلب الموظفين والطلبات الخاصة بكل شركة
            $employees = Employee::where('company_id', $company->id)->get();
            $orders = Order::where('company_id', $company->id)->get();

            // إذا ما في موظفين أو طلبات لهالشركة، نكمل على الشركة التالية
            if ($employees->isEmpty() || $orders->isEmpty()) {
                continue;
            }

            for ($i = 1; $i <= 4; $i++) {
                Project::create([
                    'company_id' => $company->id,
                    'order_id' => $orders->random()->id,
                    'employee_id' => $employees->random()->id,
                    'project_name' => 'مشروع رقم ' . $i . ' لشركة ' . $company->name,
                    'start_date' => now()->subDays(rand(20, 60)),
                    'end_date' => now()->subDays(rand(1, 10)),
                    'status' => $statuses[array_rand($statuses)],
                    'description' => 'تفاصيل مشروع رقم ' . $i,
                    'final_cost' => rand(1000, 10000),
                    'rate' => rand(1, 5),
                    'comment' => 'تعليق على المشروع رقم ' . $i,
                ]);
            }
        }
    }
}

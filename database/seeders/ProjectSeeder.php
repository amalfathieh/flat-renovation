<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $company = Company::first();
        $order = Order::first();
        $employee = Employee::first();

        Project::create([
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



    }
}

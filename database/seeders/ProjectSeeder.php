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
    public static array $projects = [];

    public function run(): void
    {

        foreach (OrderSeeder::$orders as $key => $order) {
            [$c, $z] = explode('-', $key);
            $employeeIndex = ($z <= 2) ? "1" : "2";
            $employee = EmployeeSeeder::$employees["$c-$employeeIndex"];

            self::$projects[$key] = Project::create([
                'company_id' => $order->company_id,

                'customer_id' => $order->customer_id,

                'order_id' => $order->id,
                'employee_id' => $employee->id,
                'project_name' => "مشروع زبون $z لشركة $c",
                'start_date' => now()->subDays(rand(10, 60)),
                'end_date' => now(),
                'status' => 'finished',
                'description' => 'تفاصيل المشروع',
                'final_cost' => rand(1500, 6000),

                'is_publish' => (bool) rand(0, 1),

                'rate' => rand(1, 5),
                'comment' => 'تعليق جيد',
            ]);
        }





    }
}

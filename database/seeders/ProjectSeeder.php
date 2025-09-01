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






        $projectTypes = [
            'دهان داخلي للشقق',
            'دهان خارجي للواجهات',
            'تمديدات صحية (مطبخ/حمام)',
            'صيانة كهرباء كاملة',
            'تركيب أرضيات سيراميك',
            'أعمال جبس وديكور',
            'تصليح أعطال كهربائية',
            'عزل حمامات وأسقف',
        ];

        foreach (OrderSeeder::$orders as $key => $order) {
            $userName = $order->customer->user->name;

            [$c, $z] = explode('-', $key);

            // اختيار الموظف عشوائيًا من الموظفين المتاحين للشركة
            $companyEmployees = array_filter(
                EmployeeSeeder::$employees,
                fn($index) => str_starts_with($index, "$c-"),
                ARRAY_FILTER_USE_KEY
            );

            // تحويل القيم لمصفوفة وترتيب عشوائي
            $companyEmployeesArray = array_values($companyEmployees);
            $employee = $companyEmployeesArray[array_rand($companyEmployeesArray)];

            $projectType = $projectTypes[array_rand($projectTypes)];

            $startDate = now()->subDays(rand(20, 90));
            $endDate = (rand(0, 1)) ? $startDate->copy()->addDays(rand(5, 20)) : null;
            $status = $endDate ? 'finished' : 'In progress';

            $costRanges = [
                'دهان داخلي للشقق' => [2000, 4000],
                'دهان خارجي للواجهات' => [3000, 6000],
                'تمديدات صحية (مطبخ/حمام)' => [1500, 3500],
                'صيانة كهرباء كاملة' => [2500, 5000],
                'تركيب أرضيات سيراميك' => [2000, 4500],
                'أعمال جبس وديكور' => [1800, 4000],
                'تصليح أعطال كهربائية' => [1000, 2500],
                'عزل حمامات وأسقف' => [2200, 4800],
            ];

            $range = $costRanges[$projectType] ?? [1500, 6000];

            self::$projects[$key] = Project::create([
                'company_id' => $order->company_id,
                'customer_name' => $userName,
                'order_id' => $order->id,
                'employee_id' => $employee->id,
                'project_name' => $projectType . " - $userName",
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => $status,
                'description' => "هذا المشروع عبارة عن $projectType تم تنفيذه لصالح الزبون $userName بواسطة موظف الشركة.",
                'final_cost' => rand($range[0], $range[1]),
                'is_publish' => (bool) rand(0, 1),
            ]);
        }












    }
}

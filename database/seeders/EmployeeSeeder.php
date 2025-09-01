<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{

    public static array $employees = [];

    public function run(): void
    {




        $employeesData = [
            [['first_name' => 'أحمد', 'last_name' => 'الحموي'], ['first_name' => 'ليلى', 'last_name' => 'خليل']],
            [['first_name' => 'خالد', 'last_name' => 'المهدي'], ['first_name' => 'نور', 'last_name' => 'العلي']],
            [['first_name' => 'رامي', 'last_name' => 'حسن'], ['first_name' => 'سارة', 'last_name' => 'الكردي']],
            [['first_name' => 'محمود', 'last_name' => 'إبراهيم'], ['first_name' => 'هبة', 'last_name' => 'يوسف']],
            [['first_name' => 'باسل', 'last_name' => 'صباغ'], ['first_name' => 'ديمة', 'last_name' => 'الرفاعي']],
        ];

        foreach (\Database\Seeders\CompanyDataSeeder::$companies as $c => $company) {
            if (!isset($employeesData[$c])) continue;

            foreach ($employeesData[$c] as $e => $data) {
                $user = \Database\Seeders\UserSeeder::$employees["$c-$e"];
                self::$employees["$c-$e"] = Employee::factory()->create([
                    'user_id' => $user->id,
                    'company_id' => $company->id,
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                ]);
            }
        }














        }
}

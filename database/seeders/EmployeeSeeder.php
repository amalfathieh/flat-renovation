<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        // المستخدمين يلي دورهم "موظف" (تأكد عندك جدول users فيه عمود role)
        $employeeUsers = User::where('role', 'customer')->get();

        if ($employeeUsers->isEmpty()) {
            $this->command->warn('⚠️ لا يوجد مستخدمين بدور "employee"، الرجاء إضافتهم أولاً.');
            return;
        }

        foreach ($companies as $company) {
            $employeesCount = rand(3, 5);

            for ($i = 1; $i <= $employeesCount; $i++) {
                $user = $employeeUsers->random();

                Employee::factory()->create([
                    'user_id' => $user->id,
                    'company_id' => $company->id,
                    'first_name' => 'موظف ' . $i,
                    'last_name' => 'من ' . $company->name,
                ]);
            }
        }
    }
}

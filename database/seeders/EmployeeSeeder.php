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
        foreach (CompanyDataSeeder::$companies as $c => $company) {
            for ($e = 1; $e <= 2; $e++) {
                $user = UserSeeder::$employees["$c-$e"];
                self::$employees["$c-$e"] = Employee::factory()->create([
                    'user_id' => $user->id,
                    'company_id' => $company->id,
                    'first_name' => "موظف $e",
                    'last_name' => "شركة $c",
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'employee@example.com')->first();
        $company = Company::first();

        Employee::factory()->create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'first_name' => 'الموظف',
            'last_name' => 'الأول',
        ]);
    }
}

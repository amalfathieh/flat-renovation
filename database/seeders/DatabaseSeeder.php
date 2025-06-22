<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\ProjectRating;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([


            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            CompanyDataSeeder::class,
            ServiceSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            ProjectSeeder::class,
            ProjectImageSeeder::class,
            ServiceTypeSeeder::class,
            ProjectRatingSeeder::class,
            StageSeeder::class,





        ]);


//        Company::factory(4)->create();
//       Employee::factory(20)->create();
//        Customer::factory(20)->create();

//        User::factory(2)->withRole('employee')->create();
//
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}

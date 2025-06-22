<?php
//
//namespace Database\Seeders;
//
//use App\Models\Company;
//use App\Models\Customer;
//use App\Models\Employee;
//use App\Models\Order;
//use App\Models\User;
//// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
//use Illuminate\Database\Seeder;
//
//class DatabaseSeeder extends Seeder
//{
//    /**
//     * Seed the application's database.
//     */
//    public function run(): void
//    {
//        $this->call([
//            RolesAndPermissionsSeeder::class,
//            UserSeeder::class,
//            CompanyDataSeeder::class,
////            CustomerSeeder::class,
////           EmployeeSeeder::class,
//         //  ServiceSeeder::class,
//          // OrderSeeder::class,
//      //  ProjectSeeder::class,
//        //  ProjectImageSeeder::class,
//        ]);
//
//
////        Company::factory(4)->create();
//     //  Employee::factory(20)->create();
//     //   Customer::factory(20)->create();
//      //  Order::factory(10)->create();
//      //  User::factory(2)->withRole('employee')->create();
////
////        User::factory()->create([
////            'name' => 'Test User',
////            'email' => 'test@example.com',
////        ]);
//       // User::factory(10)->withRole('customer')->create();
////        Customer::factory(10)->create(); // بيرتبطوا مع اليوزرز
////       // User::factory(10)->withRole('employee')->create();
////        Employee::factory(10)->create(); // لازم يكون فيه company_id + user_id
////        Order::factory(15)->create(); // لازم يكون فيه customer_id + company_id
////        $this->call(ProjectSeeder::class);
//
//    }
//}


namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Employee;
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
            ServiceSeeder::class,
            CompanyDataSeeder::class
        ]);


        Company::factory(4)->create();
       Employee::factory(20)->create();
        Customer::factory(20)->create();

//        User::factory(2)->withRole('employee')->create();
//
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}

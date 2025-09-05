<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public static array $orders = [];

    public function run(): void
    {





        $customers = Customer::take(5)->get();

        foreach ($customers as $custIndex => $customer) {
            foreach (CompanyDataSeeder::$companies as $c => $company) {


                $employees = Employee::where('company_id', $company->id)->get();
                if ($employees->isEmpty()) continue;


                $employee = $employees[$custIndex % $employees->count()];


                $latitude = mt_rand(3200000, 3699999) / 100000;
                $longitude = mt_rand(3500000, 4250000) / 100000;


                $key = "cust{$custIndex}-comp{$c}";

                self::$orders[$key] = Order::create([
                    'customer_id' => $customer->id,
                    'company_id'  => $company->id,
                    'employee_id' => $employee->id,
                    'status' => 'accepted',
                    'cost_of_examination' => rand(50, 200),
                    'budget' => rand(1000, 5000),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ]);


            }
        }









    }
}

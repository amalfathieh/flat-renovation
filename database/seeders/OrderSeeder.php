<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public static array $orders = [];

    public function run(): void
    {

        foreach (CompanyDataSeeder::$companies as $c => $company) {
            for ($z = 1; $z <= 4; $z++) {
                $customer = CustomerSeeder::$customers["$c-$z"];
                self::$orders["$c-$z"] = Order::create([
                    'customer_id' => $customer->id,
                    'company_id' => $company->id,
                    'status' => 'waiting',
                    'cost_of_examination' => rand(50, 200),
                    'location' => 'دمشق',
                    'budget' => rand(1000, 5000),
                ]);
            }


      }

    }
}

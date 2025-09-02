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
            for ($z = 0; $z < 4; $z++) { // ز = 0,1,2,3
                $key = "$c-$z";
                $customer = CustomerSeeder::$customers[$key] ?? null;
                if (!$customer) continue;

                self::$orders[$key] = Order::create([
                    'customer_id' => $customer->id,
                    'company_id' => $company->id,
                    'status' => 'waiting',
                    'cost_of_examination' => rand(50, 200),
                    'budget' => rand(1000, 5000),
                ]);
            }
        }









    }
}

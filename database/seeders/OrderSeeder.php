<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $customer = Customer::first();
        $company = Company::first();

        Order::create([
            'customer_id' => $customer->id,
            'company_id' => $company->id,
            'status' => 'accepted',
            'cost_of_examination' => 100.00,
            'location' => 'دمشق',
            'budget' => 3000.00,
        ]);






    }
}

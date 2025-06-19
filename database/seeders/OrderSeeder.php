<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $companies = Company::all();

        if ($customers->isEmpty() || $companies->isEmpty()) {
            $this->command->warn('لا يوجد بيانات كافية من customers أو companies.');
            return;
        }

        foreach ($companies as $company) {
            $ordersCount = rand(2, 5);

            for ($i = 0; $i < $ordersCount; $i++) {
                Order::create([
                    'customer_id' => $customers->random()->id,
                    'company_id' => $company->id,
                    'status' => 'accepted',
                    'cost_of_examination' => rand(50, 150),
                    'location' => fake()->address(),
                    'budget' => rand(1000, 5000),
                ]);
            }
        }
    }}

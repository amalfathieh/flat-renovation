<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public static array $customers = [];
    public function run(): void
    {
        foreach (UserSeeder::$customers as $key => $user) {
            self::$customers[$key] = Customer::factory()->create([
                'user_id' => $user->id,
            ]);

            }

    }
}

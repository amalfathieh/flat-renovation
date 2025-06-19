<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء 10 مستخدمين بدور customer
        $customerUsers = User::factory(10)->create()->each(function ($user) {
            $user->assignRole('customer'); // إذا عندك roles
        });

        // إنشاء العملاء وربطهم بالمستخدمين
        foreach ($customerUsers as $user) {
            Customer::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}


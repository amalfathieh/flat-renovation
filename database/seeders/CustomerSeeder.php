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



        // بيانات الزبائن الحقيقية (أسماء وعمر وجنس)
        $customersData = [
            ['name' => 'عمر الخطيب', 'phone' => '0944332211', 'age' => 28, 'gender' => 'male'],
            ['name' => 'مروان العيسى', 'phone' => '0999887766', 'age' => 35, 'gender' => 'male'],
            ['name' => 'هناء صباغ', 'phone' => '0933665522', 'age' => 30, 'gender' => 'female'],
            ['name' => 'يوسف سلامة', 'phone' => '0955443322', 'age' => 40, 'gender' => 'male'],
            ['name' => 'رنا دياب', 'phone' => '0988776655', 'age' => 25, 'gender' => 'female'],
            ['name' => 'سامر حمصي', 'phone' => '0944556677', 'age' => 32, 'gender' => 'male'],
            ['name' => 'أماني بشير', 'phone' => '0955667788', 'age' => 27, 'gender' => 'female'],
            ['name' => 'وائل شريف', 'phone' => '0966778899', 'age' => 36, 'gender' => 'male'],
            ['name' => 'هند الطويل', 'phone' => '0977889900', 'age' => 29, 'gender' => 'female'],
            ['name' => 'زياد نجم', 'phone' => '0988990011', 'age' => 33, 'gender' => 'male'],
        ];

        foreach (\Database\Seeders\UserSeeder::$customers as $key => $user) {
            $data = $customersData[$key] ?? [
                    'name' => 'مستخدم ' . $key,
                    'phone' => '09990000' . $key,
                    'age' => rand(20, 50),
                    'gender' => ['male', 'female'][rand(0,1)],
                ];

            self::$customers[$key] = Customer::factory()->create([
                'user_id' => $user->id,
                'phone'   => $data['phone'],
                'age'     => $data['age'],
                'gender'  => $data['gender'],
                'image'   => null,
            ]);
        }









    }
}

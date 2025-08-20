<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public static array $owners = [];
    public static array $employees = [];
    public static array $customers = [];


    public function run(): void
    {
        $user1 = User::create([
            'name' => 'مستخدم عادي',
            'email' => 'user@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0912345678',
            'balance' => 0,
        ]);
        $user1->customerProfile()->create([
            'phone' =>  '123456789',
            'image' => null,
            'age' => null,
            'gender' => 'female',
        ]);
        $user1->syncRoles('customer');

        $user2 = User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0999999999',
            'balance' => 0,
        ]);
        $user2->syncRoles('admin');

        $user3 = User::create([
            'name' => 'شركة 1',
            'email' => 'company@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0988888888',
            'balance' => 0,
        ]);
        $user3->syncRoles('company');

        $user22 = User::create([
            'name' => 'شركة 2',
            'email' => 'company22@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0977777777',
            'balance' => 0,
        ]);
        $user22->syncRoles('company');

        $user33 = User::create([
            'name' => 'شركة 3',
            'email' => 'company33@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0966666666',
            'balance' => 0,
        ]);
        $user33->syncRoles('company');

        $user44 = User::create([
            'name' => 'شركة 4',
            'email' => 'company44@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0955555555',
            'balance' => 0,
        ]);
        $user44->syncRoles('company');

        $user4 = User::create([
            'name' => 'مشرف',
            'email' => 'comsup@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0944444444',
            'balance' => 0,
        ]);
        $user4->syncRoles(['supervisor', 'employee']);

        $user5 = User::create([
            'name' => 'موظف لوحة التحكم',
            'email' => 'test@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0933333333',
            'balance' => 0,
        ]);
        $user5->syncRoles(['control_panel_employee', 'employee']);

        // 🔁 إنشاء مستخدمين مالكين وموظفين وزبائن وهميين
        for ($c = 1; $c <= 5; $c++) {
            self::$owners[$c] = User::factory()->withRole('company')->create([
                'name' => "مالك $c",
                'email' => "owner{$c}_@example.com",
            ]);

            for ($e = 1; $e <= 2; $e++) {
                self::$employees["$c-$e"] = User::factory()->withRole('employee')->create([
                    'name' => "موظف $e في شركة $c",
                    'email' => "employee{$c}_{$e}_@example.com",
                ]);
            }

            for ($z = 1; $z <= 4; $z++) {
                self::$customers["$c-$z"] = User::factory()->withRole('customer')->create([
                    'name' => "زبون $z لشركة $c",
                    'email' => "customer{$c}_{$z}_@example.com",
                ]);
            }
        }
    }
}

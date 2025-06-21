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
            'name' => 'user',
            'email' => 'user@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user1->customerProfile()->create([
            'phone' =>  '123456789',
            'image' => null,
            'age' => null,
            'gender' => 'female',
        ]);
        $user1->syncRoles('customer');

        $user2 = User::create([
            'name' => 'admin',
            'email' => 'admin@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user2->syncRoles('admin');

        $user3 = User::create([
            'name' => 'company',
            'email' => 'company@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user3->syncRoles('company');

        $user22 = User::create([
            'name' => 'company22',
            'email' => 'company22@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user22->syncRoles('company');

        $user33 = User::create([
            'name' => 'company33',
            'email' => 'company33@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user33->syncRoles('company');

        $user44 = User::create([
            'name' => 'company44',
            'email' => 'company44@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user44->syncRoles('company');

        $user4 = User::create([
            'name' => 'supervision',
            'email' => 'comsup@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user4->syncRoles(['supervisor', 'employee']);

        $user5 = User::create([
            'name' => 'test',
            'email' => 'test@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $user5->syncRoles(['control_panel_employee', 'employee']);

        // 🔁 إنشاء مستخدمين مالكين وموظفين وزبائن وهميين
        for ($c = 1; $c <= 5; $c++) {
            self::$owners[$c] = User::factory()->create([
                'name' => "مالك $c",
                'email' => "owner{$c}_" . uniqid() . "@example.com",
            ]);

            for ($e = 1; $e <= 2; $e++) {
                self::$employees["$c-$e"] = User::factory()->create([
                    'name' => "موظف $e في شركة $c",
                    'email' => "employee{$c}_{$e}_" . uniqid() . "@example.com",
                ]);
            }

            for ($z = 1; $z <= 4; $z++) {
                self::$customers["$c-$z"] = User::factory()->create([
                    'name' => "زبون $z لشركة $c",
                    'email' => "customer{$c}_{$z}_" . uniqid() . "@example.com",
                ]);
            }
        }
    }
}

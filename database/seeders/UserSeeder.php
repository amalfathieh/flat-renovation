<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user1 = User::create([
            'name'=>'user',
            'email' => 'user@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user1->customerProfile()->create([
            'phone' =>  '123456789',
            'image' => null,
            'age' => null,
            'gender' => 'female',
        ]);
        $user1->syncRoles('customer');

        $user2 =User::create([
            'name'=>'admin',
            'email' => 'admin@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user2->syncRoles('admin');


        $user3 =User::create([
            'name'=>'company',
            'email' => 'company@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user3->syncRoles('company');

        $user22 =User::create([
            'name'=>'company22',
            'email' => 'company22@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user22->syncRoles('company');

        $user33 =User::create([
            'name'=>'company33',
            'email' => 'company33@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user33->syncRoles('company');

        $user44 =User::create([
            'name'=>'company44',
            'email' => 'company44@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user44->syncRoles('company');

        $user4 =User::create([
            'name'=>'supervision',
            'email' => 'comsup@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user4->syncRoles(['supervisor', 'employee']);

        $user5 =User::create([
            'name'=>'test',
            'email' => 'test@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user5->syncRoles(['control_panel_employee', 'employee']);


        /// safa

        // مالك شركة
        User::factory()->create([
            'name' => 'Test Owner',
            'email' => 'owner@example.com',
        ]);

        // موظف
        User::factory()->create([
            'name' => 'الموظف الأول',
            'email' => 'employee@example.com',
        ]);

        // زبون
        User::factory()->create([
            'name' => 'اسم الزبون',
            'email' => 'customer@example.com',
        ]);
    }




}

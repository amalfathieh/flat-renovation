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
        $user1->syncRoles($user1->role_name);

        $user2 =User::create([
            'name'=>'admin',
            'email' => 'admin@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user2->syncRoles($user2->role_name);


//        $user3 =User::create([
//            'name'=>'company',
//            'email' => 'company@ex.com',
//            'email_verified_at'=> now(),
//            'role_name' => 'super_admin',
//            'password' => Hash::make('12345678'),
//        ]);
//        $user3->syncRoles($user3->role_name);

        $user4 =User::create([
            'name'=>'supervision',
            'email' => 'comsup@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user4->syncRoles($user4->role_name);

        $user5 =User::create([
            'name'=>'test',
            'email' => 'test@ex.com',
            'email_verified_at'=> now(),
            'password' => Hash::make('12345678'),
        ]);
        $user5->syncRoles($user5->role_name);
    }
}

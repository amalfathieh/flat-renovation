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
        User::create([
            'name'=>'user',
            'email' => 'user@ex.com',
            'email_verified_at'=> now(),
            'role_name' => '',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name'=>'test',
            'email' => 'test@ex.com',
            'email_verified_at'=> now(),
            'role_name' => '',
            'password' => Hash::make('12345678'),
        ]);
    }
}

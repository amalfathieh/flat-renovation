<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanyDataSeeder extends Seeder
{
    public function run(): void
    {
        $ownerUser = User::where('email', 'owner@example.com')->first();

        Company::create([
            'user_id' => $ownerUser->id,
            'name' => 'Test Company',
            'slug' => Str::slug('Test Company'),
            'location' => 'Damascus',
            'phone' => '0999888777',
            'about' => 'شركة وهمية لاختبار API.',
            'logo' =>'companies-logo/logo.png'
        ]);
    }
}

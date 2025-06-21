<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanyDataSeeder extends Seeder
{

    public static array $companies = [];

    public function run(): void
    {

        foreach (UserSeeder::$owners as $c => $owner) {
            self::$companies[$c] = Company::create([
                'user_id' => $owner->id,
                'name' => "شركة $c",
                'slug' => \Str::slug("شركة $c"),
                'location' => 'دمشق',
                'phone' => "09999$c$c$c$c",
                'about' => 'شركة لأغراض الاختبار',
                'logo' => 'logo.png',
            ]);
        }


    }
}

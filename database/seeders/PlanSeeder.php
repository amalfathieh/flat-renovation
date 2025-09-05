<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $plans = [
            [
                'name' => 'Free',
                'price' => 0,
                'project_limit' => 1,
                'duration_in_days' => 5,
                'description' => "
    باقة تتيح التجريب مجانا
    -صالحة لمدة 5 ايام
        -انشاء مشروع
        - ضع له مراحل
        -تابع مع الزبون
                            "
            ],

            [
                'name' => 'Starter',
                'price' => 100,
                'project_limit' => 2,
                'duration_in_days' => 30,
                'description' => '
     -باقة ابتدائية بسعر منخفض
     صالحة لمدة شهر كامل
    -انشاء مشروع
    - ضع له مراحل
    -تابع مع الزبون
                '
            ],
            [
                'name' => 'توفيرية',
                'price' => 130,
                'project_limit' => 4,
                'duration_in_days' => 30,
                'description' => "
    باقة توفيرية بسعر منخفض
    وعدد مشاريع مضاعفة
    صالحة لمدة شهر كامل
      -انشاء مشروع
      - ضع له مراحل
      - تابع مع الزبون
                  "
            ],
            [
                'name' => 'موسعة',
                'price' => 200,
                'project_limit' => 10,
                'duration_in_days' => 30,
                'description' => "
     باقة موسعة بسعر منخفض
    صالحة لمدة شهر كامل
    -انشاء مشروع
    - ضع له مراحل
    - تابع مع الزبون
                "
            ],

        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create([
                'name' => $plan['name'],
                'price' => $plan['price'],
                'project_limit' => $plan['project_limit'],
                'duration_in_days' => $plan['duration_in_days'],
                'description' => $plan['description'],
            ]);
        }
    }
}

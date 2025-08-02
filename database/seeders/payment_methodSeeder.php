<?php

namespace Database\Seeders;

use App\Models\payment_method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stripe\PaymentMethod;

class payment_methodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        payment_method::create([
            'name' => 'MTN Cash',
            'is_active' => true,
            'instructions' => [
                'account' => '0999123456',
                'note' => 'Write your full name on the transfer.',
            ],
        ]);

        payment_method::create([
            'name' => 'Syriatel Cash',
            'is_active' => true,
            'instructions' => [
                'account' => '0988123456',
                'note' => 'Enter the invoice number',
            ],
        ]);

        payment_method::create([
            'name' => 'Transfer via Haram branch',
            'is_active' => true,
            'instructions' => [
                'branch' => 'Mazzeh branch',
                'name' => 'Mohammed Khaled',
                'phone' => '0983449075',
            ],
        ]);


    }
}

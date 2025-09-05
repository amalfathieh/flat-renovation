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


        // 🟢 مستخدمين أساسيين للتجربة
        $user1 = User::create([
            'name' => 'مستخدم عادي',
            'email' => 'user@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0912345678',
            'balance' => 0,
        ]);
        $user1->customerProfile()->create([
            'phone' => '0912345678',
            'image' => null,
            'age' => 28,
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
            'name' => 'المشرف العام',
            'email' => 'supervisor@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0944444444',
            'balance' => 0,
        ]);
        $user3->syncRoles(['supervisor', 'employee']);

        $user4 = User::create([
            'name' => 'موظف لوحة التحكم',
            'email' => 'panel@ex.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'payment_phone' => '0933333333',
            'balance' => 0,
        ]);
        $user4->syncRoles(['control_panel_employee', 'employee']);

        // 🟢 ملاك الشركات + موظفين + زبائن
        $ownersData = [
            ['name' => 'خالد درويش', 'email' => 'khaled.owner@example.com', 'phone' => '0988111222'],
            ['name' => 'مروان السيد', 'email' => 'marwan.owner@example.com', 'phone' => '0977665544'],
            ['name' => 'أحمد حجازي', 'email' => 'ahmad.owner@example.com', 'phone' => '0966554433'],
            ['name' => 'ليلى عبدو', 'email' => 'layla.owner@example.com', 'phone' => '0955443322'],
            ['name' => 'رامي منصور', 'email' => 'rami.owner@example.com', 'phone' => '0944332211'],
        ];

        $employeesData = [
            ['أحمد ناصر', 'ahmad.nasser@example.com'],
            ['ليلى خليل', 'layla.khalil@example.com'],
            ['رامي حسن', 'rami.hasan@example.com'],
            ['سارة كردي', 'sara.kurdi@example.com'],
            ['محمود إبراهيم', 'mahmoud.ibrahim@example.com'],
            ['هبة يوسف', 'hiba.youssef@example.com'],
            ['باسل صباغ', 'basel.sabbagh@example.com'],
            ['ديمة رفاعي', 'dima.refaie@example.com'],
            ['نور علي', 'nour.ali@example.com'],
            ['خالد مهدي', 'khaled.mahdi@example.com'],
        ];

        $customersData = [
            ['عمر الخطيب', 'omar.khateeb@example.com'],
            ['مروان العيسى', 'marwan.issa@example.com'],
            ['هناء صباغ', 'hana.sabbagh@example.com'],
            ['يوسف سلامة', 'yousef.salama@example.com'],
            ['رنا دياب', 'rana.diab@example.com'],
            ['سامر حمصي', 'samer.homsi@example.com'],
            ['دلال حمدان', 'dalal.hamdan@example.com'],
            ['جاد الحلبي', 'jad.halabi@example.com'],
            ['أماني بشير', 'amani.basheer@example.com'],
            ['وائل شريف', 'wael.sharif@example.com'],
            ['هند الطويل', 'hind.taweel@example.com'],
            ['خليل طه', 'khalil.taha@example.com'],
            ['منى شهاب', 'mona.shehab@example.com'],
            ['فادي الزين', 'fadi.zein@example.com'],
            ['ميساء سيف', 'maysa.sayf@example.com'],
            ['زياد نجم', 'ziad.najm@example.com'],
            ['سلوى رفيق', 'salwa.rafeeq@example.com'],
            ['طارق عيسى', 'tarek.issa@example.com'],
            ['ريم نصار', 'reem.nassar@example.com'],
            ['نادر رستم', 'nader.rustom@example.com'],
        ];

        // إنشاء الملاك + موظفين + زبائن
        foreach ($ownersData as $c => $owner) {
            self::$owners[$c] = User::create([
                'name' => $owner['name'],
                'email' => $owner['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'payment_phone' => $owner['phone'],
                'balance' => 0,
            ]);
            self::$owners[$c]->syncRoles('company');

            // موظفين لكل شركة (2 موظف)
            for ($e = 0; $e < 2; $e++) {
                $index = ($c * 2) + $e;
                if (isset($employeesData[$index])) {
                    $emp = $employeesData[$index];
                    self::$employees["$c-$e"] = User::create([
                        'name' => $emp[0],
                        'email' => $emp[1],
                        'email_verified_at' => now(),
                        'password' => Hash::make('12345678'),
                        'payment_phone' => '09' . rand(100000000, 999999999),
                        'balance' => 0,
                    ]);
                    self::$employees["$c-$e"]->syncRoles('employee');
                }
            }

            // زبائن لكل شركة (4 زبائن)
            for ($z = 0; $z < 4; $z++) {
                $index = ($c * 4) + $z;
                if (isset($customersData[$index])) {
                    $cust = $customersData[$index];
                    self::$customers["$c-$z"] = User::create([
                        'name' => $cust[0],
                        'email' => $cust[1],
                        'email_verified_at' => now(),
                        'password' => Hash::make('12345678'),
                        'payment_phone' => '09' . rand(100000000, 999999999),
                        'balance' => 0,
                    ]);
                    self::$customers["$c-$z"]->syncRoles('customer');
                }
            }
        }

    }
}

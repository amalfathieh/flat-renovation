<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // ✅ هذا هو المطلوب

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['customer', 'company', 'super_admin', 'supervisor'];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        $this->command->info('Roles created successfully.');
    }
}

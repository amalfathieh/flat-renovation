<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $permissions = [
            //Admin employee
//            'role_control',

            'view_company_dashboard',

            'employee_control', 'employee_view',

            'block_user',

            'company_create',  'company_view', 'company_edit',

            'user_create', 'user_view','user_edit', 'user_delete',

            //لادارة المشرفين والموظفيين
            'manage_users',
            //الشكاوي
            'complaint_create', 'complaint_view','complaint_edit', 'complaint_delete',

            'order_create', 'order_status_edit', 'order_view', 'order_delete',

            'appointment_create', 'appointment_view', 'appointment_delete',

            'project_create', 'project_view',  'project_edit', 'project_delete',
            'create_stage', 'view_stage', 'update_stage', 'delete_stage',

            'service_create', 'service_view','service_edit', 'service_delete',
            //الاعتراضات
            'objection_create', 'objection_view', 'objection_delete',

        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $owner = Role::firstOrCreate(['name' => 'admin'])->givePermissionTo($permissions);

        $userRole = Role::firstOrCreate(['name' => 'customer'])->givePermissionTo([
            'complaint_create', 'user_create', 'user_view','user_edit', 'user_delete', 'project_view',
            'service_view', 'objection_create', 'objection_view', 'objection_delete',
            'order_create', 'order_view', 'order_delete',
        ]);

        $companyRole = Role::firstOrCreate(['name' => 'company'])->givePermissionTo([
//            'role_control',
            'employee_control', 'employee_view',
            'company_create',  'company_view', 'company_edit',
            'order_view', 'order_delete','order_status_edit',
            'appointment_create', 'appointment_view', 'appointment_delete',

            'project_create', 'project_view',  'project_edit', 'project_delete',

            'service_create', 'service_view','service_edit', 'service_delete',
            'objection_create', 'objection_view',
        ]);

        Role::firstOrCreate(['name' => 'control_panel_employee'])->givePermissionTo([
            'company_view',
            'user_view','user_edit', 'user_delete',
            'block_user',
            //الشكاوي
            'complaint_create', 'complaint_view','complaint_edit', 'complaint_delete',

            'service_view',
        ]);


        Role::firstOrCreate(['name' => 'supervisor'])->givePermissionTo([
            'view_company_dashboard',
            //الشكاوي
             'complaint_view',
            'create_stage','update_stage',

            'order_view','order_status_edit',
            //الاعتراضات
            'objection_create', 'objection_view',
            'project_create','project_view', 'project_edit',
            'create_stage', 'view_stage', 'update_stage', 'delete_stage',

            'service_view',
        ]);

        Role::firstOrCreate(['name' => 'employee']);
    }
}

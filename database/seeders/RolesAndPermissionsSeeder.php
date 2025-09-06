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
            // CompanySubscriptionResource
            'view_companysubscription', 'view_any_companysubscription', 'create_companysubscription', 'update_companysubscription', 'delete_companysubscription',

            // EmployeeResource
            'view_employee', 'view_any_employee', 'create_employee', 'update_employee', 'delete_employee',

            // ObjectionResource
            'view_objection', 'view_any_objection', 'delete_objection',

            // OrderResource
            'view_order', 'view_any_order', 'update_order', 'delete_order',

            // PaymentMethodResource
            'view_paymentmethod', 'view_any_paymentmethod', 'create_paymentmethod', 'update_paymentmethod', 'delete_paymentmethod',


            // ProjectResource
            'view_project', 'view_any_project', 'create_project', 'update_project', 'delete_project',

            // ProjectStageResource
            'view_projectstage', 'view_any_projectstage', 'create_projectstage', 'update_projectstage', 'delete_projectstage',

            // ServiceResource
            'view_service', 'view_any_service', 'create_service', 'update_service', 'delete_service',

            // ServiceTypeResource
            'view_servicetype', 'view_any_servicetype', 'create_servicetype', 'update_servicetype', 'delete_servicetype',

            // TopupRequestResource
            'view_topuprequest', 'view_any_topuprequest', 'create_topuprequest', 'update_topuprequest', 'delete_topuprequest',

            // TransactionsAllResource
            'view_transactionsall', 'view_any_transactionsall', 'delete_transactionsall',

            //ADMAIN
            // CompanyResource.php
            'view_company',
            'admin_view_any_company',
            'admin_create_company',
            'admin_update_company',
            'admin_delete_company',

// External TransferDashboardResource.php
            'admin_view_externaltransferdashboard',
            'admin_view_any_externaltransferdashboard',
            'admin_create_externaltransferdashboard',
            'admin_update_externaltransferdashboard',
            'admin_delete_externaltransferdashboard',

// External TransferResource.php
            'admin_view_externaltransfer',
            'admin_view_any_externaltransfer',
            'admin_create_externaltransfer',
            'admin_update_externaltransfer',
            'admin_delete_externaltransfer',

// RoleResource.php
            'view_role',
            'view_any_role',
            'create_role',
            'update_role',
            'delete_role',

// SubscriptionPlanResource.php
            'view_subscriptionplan',
            'view_any_subscriptionplan',
            'admin_create_subscriptionplan',
            'admin_update_subscriptionplan',
            'admin_delete_subscriptionplan',

// UserResource.php
            'admin_view_user',
            'admin_view_any_user',
//            'admin_create_user',
            'admin_update_user',
            'admin_delete_user',

            /////////////
            'create_objection',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $owner = Role::firstOrCreate(['name' => 'admin'])->givePermissionTo($permissions);

        $userRole = Role::firstOrCreate(['name' => 'customer'])->givePermissionTo([
            'view_objection', 'create_objection', 'delete_objection',
            'view_order', 'delete_order',
            'view_paymentmethod',
            'view_project', 'view_projectstage',
            'view_service', 'view_servicetype',
            'view_topuprequest', 'create_topuprequest',
            'view_transactionsall',
            'view_company',
        ]);

        $companyRole = Role::firstOrCreate([
            'name' => 'company',
            'to_company' => true,
            ])->givePermissionTo([
            'view_any_role',

            'view_companysubscription', 'create_companysubscription', 'update_companysubscription', 'delete_companysubscription',

            'view_employee', 'view_any_employee', 'create_employee', 'update_employee', 'delete_employee',

            'view_objection', 'view_any_objection', 'delete_objection',

            'view_order', 'view_any_order', 'update_order', 'delete_order',

            'view_paymentmethod', 'view_any_paymentmethod',

            'view_project', 'view_any_project', 'create_project', 'update_project', 'delete_project',

            'view_projectstage', 'view_any_projectstage', 'create_projectstage', 'update_projectstage', 'delete_projectstage',

            'view_service', 'view_any_service', 'create_service', 'update_service', 'delete_service',

            'view_servicetype', 'view_any_servicetype', 'create_servicetype', 'update_servicetype', 'delete_servicetype',

            'view_topuprequest', 'view_any_topuprequest', 'create_topuprequest', 'update_topuprequest', 'delete_topuprequest',

            'view_transactionsall', 'view_any_transactionsall', 'delete_transactionsall',
        ]);

        Role::firstOrCreate([
            'name' => 'control_panel_employee',
            'to_company' => true,
        ])->givePermissionTo([
            'view_employee', 'view_any_employee', 'create_employee', 'update_employee', 'delete_employee',
        ]);


        Role::firstOrCreate(['name' =>
            'supervisor',
            'to_company' => true,

        ])->givePermissionTo([

            'view_objection', 'view_any_objection',

            'view_order', 'view_any_order',

            'view_project', 'view_any_project', 'create_project', 'update_project',

            'view_projectstage', 'view_any_projectstage', 'create_projectstage', 'update_projectstage', 'delete_projectstage',

            'view_service', 'view_any_service', 'create_service', 'update_service',

            'view_servicetype', 'view_any_servicetype', 'create_servicetype', 'update_servicetype',
        ]);


        Role::firstOrCreate(['name' => 'employee']);


        Role::firstOrCreate(['name' => 'base_permissions'])->givePermissionTo([

            'view_employee', 'view_any_employee', 'create_employee', 'update_employee', 'delete_employee',

            'view_objection', 'view_any_objection', 'delete_objection',

            'view_order', 'view_any_order', 'update_order', 'delete_order',

            'view_project', 'view_any_project', 'create_project', 'update_project', 'delete_project',

            'view_projectstage', 'view_any_projectstage', 'create_projectstage', 'update_projectstage', 'delete_projectstage',

            'view_service', 'view_any_service', 'create_service', 'update_service', 'delete_service',

            'view_servicetype', 'view_any_servicetype', 'create_servicetype', 'update_servicetype', 'delete_servicetype',

            'view_topuprequest', 'view_any_topuprequest',

            'view_transactionsall', 'view_any_transactionsall', 'delete_transactionsall',
        ]);

    }

}

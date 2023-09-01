<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $permissions = [
            'create_users' => 'Creates users',
            'manage_users' => 'Manage users',
            'view_users' => '',
            'show_user' => 'View user details',
            'verify_user' => 'Verifies user',
            'user_delete' => 'delete user',
            'restore_user' => 'restore delete user',
            'view_configs' => 'can view system configurations',
            'access_uploads' => 'Access uploads',
            'perform_uploads' => 'Performs uploads',
            'verify_uploads' => 'Verifies uploads',
            'create_role' => 'Create role',
            'manage_role' => 'Manage roles',
            'view_roles' => 'View roles',
            'verify_roles' => 'Verifies roles',
            'view_permissions' => '',
            'feedbacks' => 'capture new branch',
            'coupons' => 'view branches listing',
            'portal_users' => 'manage portal users',
            'employee_users' => 'Employees',
            'delivery_parcels' => 'view locations listing',
            'view_riders_usage'=> 'Check on riders',
            'notifications' => 'manage (edit/update) locations',
            'change_password' => 'change own password',
            'manage_organizations' => 'change own password'

        ];

        foreach ($permissions as $name => $desc) {
            Permission::updateOrCreate(['name' => $name], ['name' => $name, 'description' => $desc]);
        }


        $perms = Permission::all();
        $excludePerms = Arr::except($perms, ['coupons', 'feedbacks','employee_users', 'delivery_parcels', 'view_riders_usage']);
        $roles = ['super-admin' => "Administrator (All access)"];

        foreach ($roles as $name => $desc) {
            $role = Role::updateOrCreate(['name' => $name], ['name' => $name, 'description' => $desc]);
            $role->syncPermissions($excludePerms);
        }


        //corporate Client

        $name = 'corporate';
        $desc = 'Manage client users ';
        $corporate_role = Role::updateOrCreate(['name' => $name], ['name' => $name, 'description' => $desc]);

        $corporate_permissions = ['feedbacks',
        'coupons','portal_users','employee_users','delivery_parcels','view_riders_usage','notifications','change_password'];
        $corporate_permissions = Permission::whereIn('name', $corporate_permissions)->get();
        $corporate_role->syncPermissions($corporate_permissions);




    }
}

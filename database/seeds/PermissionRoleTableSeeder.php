<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use App\Services\PermissionService;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $adminPermissions = Permission::all();
        Role::query()
            ->findOrFail(PermissionService::ROLE_ADMIN_ID)
            ->permissions()
            ->sync($adminPermissions->pluck('id'));

        $userPermissions = $adminPermissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 11) != 'permission_';
        });

        Role::query()
            ->findOrFail(2)
            ->permissions()
            ->sync($userPermissions);
    }
}

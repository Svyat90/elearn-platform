<?php

use App\User;
use Illuminate\Database\Seeder;
use \App\Services\PermissionService;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::query()
            ->findOrFail(PermissionService::ROLE_ADMIN_ID)
            ->roles()
            ->sync(PermissionService::ROLE_ADMIN_ID);
    }
}

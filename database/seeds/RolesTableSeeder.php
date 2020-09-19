<?php

use App\Role;
use Illuminate\Database\Seeder;
use App\Services\PermissionService;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => PermissionService::ROLE_ADMIN_ID, 'title' => 'Admin'],
            ['id' => 2, 'title' => 'User'],
        ];

        Role::query()->insert($roles);
    }
}

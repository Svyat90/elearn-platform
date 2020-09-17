<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['id' => 1, 'title' => 'user_management_access'],
            ['id' => 2, 'title' => 'permission_create'],
            ['id' => 3, 'title' => 'permission_edit'],
            ['id' => 4, 'title' => 'permission_show'],
            ['id' => 5, 'title' => 'permission_delete'],
            ['id' => 6, 'title' => 'permission_access'],
            ['id' => 7, 'title' => 'role_create'],
            ['id' => 8, 'title' => 'role_edit'],
            ['id' => 9, 'title' => 'role_show'],
            ['id' => 10, 'title' => 'role_delete'],
            ['id' => 11, 'title' => 'role_access'],
            ['id' => 12, 'title' => 'user_create'],
            ['id' => 13, 'title' => 'user_edit'],
            ['id' => 14, 'title' => 'user_show'],
            ['id' => 15, 'title' => 'user_delete'],
            ['id' => 16, 'title' => 'user_access'],
            ['id' => 17, 'title' => 'category_create'],
            ['id' => 18, 'title' => 'category_edit'],
            ['id' => 19, 'title' => 'category_show'],
            ['id' => 20, 'title' => 'category_delete'],
            ['id' => 21, 'title' => 'category_access'],
            ['id' => 50, 'title' => 'content_management_access'],
            ['id' => 51, 'title' => 'audit_log_show'],
            ['id' => 52, 'title' => 'audit_log_access'],
            ['id' => 78, 'title' => 'admin_user_create'],
            ['id' => 79, 'title' => 'admin_user_edit'],
            ['id' => 80, 'title' => 'admin_user_show'],
            ['id' => 81, 'title' => 'admin_user_delete'],
            ['id' => 82, 'title' => 'admin_user_access'],
            ['id' => 86, 'title' => 'sub_category_create'],
            ['id' => 87, 'title' => 'sub_category_edit'],
            ['id' => 88, 'title' => 'sub_category_show'],
            ['id' => 89, 'title' => 'sub_category_delete'],
            ['id' => 90, 'title' => 'sub_category_access'],
            ['id' => 162, 'title' => 'profile_password_edit'],
        ];

        Permission::query()->insert($permissions);
    }
}

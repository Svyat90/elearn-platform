<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'user_management_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'category_create',
            'category_edit',
            'category_show',
            'category_delete',
            'category_access',
            'content_management_access',
            'audit_log_show',
            'audit_log_access',
            'sub_category_create',
            'sub_category_edit',
            'sub_category_show',
            'sub_category_delete',
            'sub_category_access',
            'profile_password_edit',
            'document_create',
            'document_edit',
            'document_show',
            'document_delete',
            'document_access',
            'course_create',
            'course_edit',
            'course_show',
            'course_delete',
            'course_access',
            'setting_edit',
            'setting_update',
            'setting_access',
        ];

        $insertData = array_map(fn ($row) => ['title' => $row], $permissions);

        Permission::query()->insert($insertData);
    }
}

<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Services\PermissionService;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => PermissionService::ROLE_ADMIN_ID,
                'email'          => 'admin@admin.com',
                'password'       => Hash::make('password'),
                'user_status'    => User::USER_STATUS_ACTIVE
            ],
        ];

        User::query()->insert($users);
    }
}

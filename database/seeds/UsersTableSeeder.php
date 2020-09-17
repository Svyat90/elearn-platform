<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$RyVYCGWVxLArEjs3qekLneR926J/KuXRe3YX1VW2Sre8YTSEGAGMG', // password
            ],
        ];

        User::query()->insert($users);
    }
}

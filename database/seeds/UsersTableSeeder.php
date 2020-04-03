<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                  => 1,
                'name'                => 'Admin',
                'email'               => 'admin@admin.com',
                'password'            => '$2y$10$QJn7lJJHY86XZ92ArNBYG.AjADFbCYWoXFn5AiicWxdzgJY.6TVs6',
                'remember_token'      => null,
                'first_name'          => '',
                'last_name'           => '',
                'position_occupation' => '',
                'bio'                 => '',
                'referral_code'       => '',
                'referred_by'         => '',
            ],
        ];

        User::insert($users);

    }
}

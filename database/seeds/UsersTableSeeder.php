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
                'password'            => '$2y$10$WXcThf7CiXnI8xS8x.shK.lZNcXHXDS8rEIxOL9tGCbkgOwLj9qaS',
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

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
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$FFmTU.k5zJlxV8ZGIEERZ.QaSxpAvwLcmXaWlMZ8lvS418XUBBZwW',
                'remember_token' => null,
                'first_name'     => '',
                'last_name'      => '',
                'referral_code'  => '',
                'referred_by'    => '',
                'mobile_no'      => '',
                'ig_token'       => '',
                'ig_username'    => '',
            ],
        ];

        User::insert($users);

    }
}

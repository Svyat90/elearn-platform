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
                'password'       => '$2y$10$TcgwZZ2e098jG3MB7dcKs.mhlHz8dZ8Tua27aCndqo2SqWpy02I3e',
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

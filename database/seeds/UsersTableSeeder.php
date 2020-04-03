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
                'password'            => '$2y$10$PriV3A4tfuOF2o49aisw0.a4Ax0DD5W5HoOjW1SbN8ID3VyguRA.6',
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

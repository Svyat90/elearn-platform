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
                'password'            => '$2y$10$Es.XJe4UwPf0k69H/1Jg5uDf2Oqi3SVwW/H/8eOSgF6pwm5m5KkIK',
                'remember_token'      => null,
                'first_name'          => '',
                'last_name'           => '',
                'position_occupation' => '',
                'bio'                 => '',
            ],
        ];

        User::insert($users);

    }
}

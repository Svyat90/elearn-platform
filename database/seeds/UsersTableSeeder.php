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
                'password'            => '$2y$10$ufoyyo7K2XthbH1VlVNYS.O7UUy0ZlxRr734tdX7iNJuLdPH1zF/q',
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

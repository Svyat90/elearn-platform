<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'category_create',
            ],
            [
                'id'    => '18',
                'title' => 'category_edit',
            ],
            [
                'id'    => '19',
                'title' => 'category_show',
            ],
            [
                'id'    => '20',
                'title' => 'category_delete',
            ],
            [
                'id'    => '21',
                'title' => 'category_access',
            ],
            [
                'id'    => '22',
                'title' => 'country_create',
            ],
            [
                'id'    => '23',
                'title' => 'country_edit',
            ],
            [
                'id'    => '24',
                'title' => 'country_show',
            ],
            [
                'id'    => '25',
                'title' => 'country_delete',
            ],
            [
                'id'    => '26',
                'title' => 'country_access',
            ],
            [
                'id'    => '27',
                'title' => 'language_create',
            ],
            [
                'id'    => '28',
                'title' => 'language_edit',
            ],
            [
                'id'    => '29',
                'title' => 'language_show',
            ],
            [
                'id'    => '30',
                'title' => 'language_delete',
            ],
            [
                'id'    => '31',
                'title' => 'language_access',
            ],
            [
                'id'    => '32',
                'title' => 'tag_create',
            ],
            [
                'id'    => '33',
                'title' => 'tag_edit',
            ],
            [
                'id'    => '34',
                'title' => 'tag_show',
            ],
            [
                'id'    => '35',
                'title' => 'tag_delete',
            ],
            [
                'id'    => '36',
                'title' => 'tag_access',
            ],
            [
                'id'    => '37',
                'title' => 'page_create',
            ],
            [
                'id'    => '38',
                'title' => 'page_edit',
            ],
            [
                'id'    => '39',
                'title' => 'page_show',
            ],
            [
                'id'    => '40',
                'title' => 'page_delete',
            ],
            [
                'id'    => '41',
                'title' => 'page_access',
            ],
            [
                'id'    => '42',
                'title' => 'search_log_create',
            ],
            [
                'id'    => '43',
                'title' => 'search_log_edit',
            ],
            [
                'id'    => '44',
                'title' => 'search_log_show',
            ],
            [
                'id'    => '45',
                'title' => 'search_log_delete',
            ],
            [
                'id'    => '46',
                'title' => 'search_log_access',
            ],
            [
                'id'    => '47',
                'title' => 'social_medium_create',
            ],
            [
                'id'    => '48',
                'title' => 'social_medium_edit',
            ],
            [
                'id'    => '49',
                'title' => 'social_medium_show',
            ],
            [
                'id'    => '50',
                'title' => 'social_medium_delete',
            ],
            [
                'id'    => '51',
                'title' => 'social_medium_access',
            ],
            [
                'id'    => '52',
                'title' => 'referral_commission_create',
            ],
            [
                'id'    => '53',
                'title' => 'referral_commission_edit',
            ],
            [
                'id'    => '54',
                'title' => 'referral_commission_show',
            ],
            [
                'id'    => '55',
                'title' => 'referral_commission_delete',
            ],
            [
                'id'    => '56',
                'title' => 'referral_commission_access',
            ],
            [
                'id'    => '57',
                'title' => 'content_management_access',
            ],
            [
                'id'    => '58',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '59',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '60',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}

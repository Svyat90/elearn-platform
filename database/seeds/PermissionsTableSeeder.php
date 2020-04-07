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
                'title' => 'order_create',
            ],
            [
                'id'    => '61',
                'title' => 'order_edit',
            ],
            [
                'id'    => '62',
                'title' => 'order_show',
            ],
            [
                'id'    => '63',
                'title' => 'order_delete',
            ],
            [
                'id'    => '64',
                'title' => 'order_access',
            ],
            [
                'id'    => '65',
                'title' => 'video_create',
            ],
            [
                'id'    => '66',
                'title' => 'video_edit',
            ],
            [
                'id'    => '67',
                'title' => 'video_show',
            ],
            [
                'id'    => '68',
                'title' => 'video_delete',
            ],
            [
                'id'    => '69',
                'title' => 'video_access',
            ],
            [
                'id'    => '70',
                'title' => 'user_review_create',
            ],
            [
                'id'    => '71',
                'title' => 'user_review_edit',
            ],
            [
                'id'    => '72',
                'title' => 'user_review_show',
            ],
            [
                'id'    => '73',
                'title' => 'user_review_delete',
            ],
            [
                'id'    => '74',
                'title' => 'user_review_access',
            ],
            [
                'id'    => '75',
                'title' => 'gender_create',
            ],
            [
                'id'    => '76',
                'title' => 'gender_edit',
            ],
            [
                'id'    => '77',
                'title' => 'gender_show',
            ],
            [
                'id'    => '78',
                'title' => 'gender_delete',
            ],
            [
                'id'    => '79',
                'title' => 'gender_access',
            ],
            [
                'id'    => '80',
                'title' => 'order_history_create',
            ],
            [
                'id'    => '81',
                'title' => 'order_history_edit',
            ],
            [
                'id'    => '82',
                'title' => 'order_history_show',
            ],
            [
                'id'    => '83',
                'title' => 'order_history_delete',
            ],
            [
                'id'    => '84',
                'title' => 'order_history_access',
            ],
            [
                'id'    => '85',
                'title' => 'order_payment_create',
            ],
            [
                'id'    => '86',
                'title' => 'order_payment_edit',
            ],
            [
                'id'    => '87',
                'title' => 'order_payment_show',
            ],
            [
                'id'    => '88',
                'title' => 'order_payment_delete',
            ],
            [
                'id'    => '89',
                'title' => 'order_payment_access',
            ],
            [
                'id'    => '90',
                'title' => 'orders_list_access',
            ],
            [
                'id'    => '91',
                'title' => 'product_management_access',
            ],
            [
                'id'    => '92',
                'title' => 'product_category_create',
            ],
            [
                'id'    => '93',
                'title' => 'product_category_edit',
            ],
            [
                'id'    => '94',
                'title' => 'product_category_show',
            ],
            [
                'id'    => '95',
                'title' => 'product_category_delete',
            ],
            [
                'id'    => '96',
                'title' => 'product_category_access',
            ],
            [
                'id'    => '97',
                'title' => 'product_tag_create',
            ],
            [
                'id'    => '98',
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => '99',
                'title' => 'product_tag_show',
            ],
            [
                'id'    => '100',
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => '101',
                'title' => 'product_tag_access',
            ],
            [
                'id'    => '102',
                'title' => 'product_create',
            ],
            [
                'id'    => '103',
                'title' => 'product_edit',
            ],
            [
                'id'    => '104',
                'title' => 'product_show',
            ],
            [
                'id'    => '105',
                'title' => 'product_delete',
            ],
            [
                'id'    => '106',
                'title' => 'product_access',
            ],
            [
                'id'    => '107',
                'title' => 'customer_management_access',
            ],
            [
                'id'    => '108',
                'title' => 'amin_user_create',
            ],
            [
                'id'    => '109',
                'title' => 'amin_user_edit',
            ],
            [
                'id'    => '110',
                'title' => 'amin_user_show',
            ],
            [
                'id'    => '111',
                'title' => 'amin_user_delete',
            ],
            [
                'id'    => '112',
                'title' => 'amin_user_access',
            ],
            [
                'id'    => '113',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}

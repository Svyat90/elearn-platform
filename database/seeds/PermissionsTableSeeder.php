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
                'title' => 'content_management_access',
            ],
            [
                'id'    => '53',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '54',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '55',
                'title' => 'order_create',
            ],
            [
                'id'    => '56',
                'title' => 'order_edit',
            ],
            [
                'id'    => '57',
                'title' => 'order_show',
            ],
            [
                'id'    => '58',
                'title' => 'order_delete',
            ],
            [
                'id'    => '59',
                'title' => 'order_access',
            ],
            [
                'id'    => '60',
                'title' => 'video_create',
            ],
            [
                'id'    => '61',
                'title' => 'video_edit',
            ],
            [
                'id'    => '62',
                'title' => 'video_show',
            ],
            [
                'id'    => '63',
                'title' => 'video_delete',
            ],
            [
                'id'    => '64',
                'title' => 'video_access',
            ],
            [
                'id'    => '65',
                'title' => 'user_review_create',
            ],
            [
                'id'    => '66',
                'title' => 'user_review_edit',
            ],
            [
                'id'    => '67',
                'title' => 'user_review_show',
            ],
            [
                'id'    => '68',
                'title' => 'user_review_delete',
            ],
            [
                'id'    => '69',
                'title' => 'user_review_access',
            ],
            [
                'id'    => '70',
                'title' => 'gender_create',
            ],
            [
                'id'    => '71',
                'title' => 'gender_edit',
            ],
            [
                'id'    => '72',
                'title' => 'gender_show',
            ],
            [
                'id'    => '73',
                'title' => 'gender_delete',
            ],
            [
                'id'    => '74',
                'title' => 'gender_access',
            ],
            [
                'id'    => '75',
                'title' => 'order_payment_show',
            ],
            [
                'id'    => '76',
                'title' => 'order_payment_delete',
            ],
            [
                'id'    => '77',
                'title' => 'order_payment_access',
            ],
            [
                'id'    => '78',
                'title' => 'orders_list_access',
            ],
            [
                'id'    => '79',
                'title' => 'customer_management_access',
            ],
            [
                'id'    => '80',
                'title' => 'admin_user_create',
            ],
            [
                'id'    => '81',
                'title' => 'admin_user_edit',
            ],
            [
                'id'    => '82',
                'title' => 'admin_user_show',
            ],
            [
                'id'    => '83',
                'title' => 'admin_user_delete',
            ],
            [
                'id'    => '84',
                'title' => 'admin_user_access',
            ],
            [
                'id'    => '85',
                'title' => 'media_management_access',
            ],
            [
                'id'    => '86',
                'title' => 'site_log_access',
            ],
            [
                'id'    => '87',
                'title' => 'site_management_access',
            ],
            [
                'id'    => '88',
                'title' => 'sub_category_create',
            ],
            [
                'id'    => '89',
                'title' => 'sub_category_edit',
            ],
            [
                'id'    => '90',
                'title' => 'sub_category_show',
            ],
            [
                'id'    => '91',
<<<<<<< HEAD
                'title' => 'customer_management_access',
            ],
            [
                'id'    => '92',
                'title' => 'admin_user_create',
            ],
            [
                'id'    => '93',
                'title' => 'admin_user_edit',
            ],
            [
                'id'    => '94',
                'title' => 'admin_user_show',
            ],
            [
                'id'    => '95',
                'title' => 'admin_user_delete',
            ],
            [
                'id'    => '96',
                'title' => 'admin_user_access',
            ],
            [
                'id'    => '97',
                'title' => 'media_management_access',
            ],
            [
                'id'    => '98',
                'title' => 'site_log_access',
            ],
            [
                'id'    => '99',
                'title' => 'site_management_access',
            ],
            [
                'id'    => '100',
                'title' => 'sub_category_create',
            ],
            [
                'id'    => '101',
                'title' => 'sub_category_edit',
            ],
            [
                'id'    => '102',
                'title' => 'sub_category_show',
            ],
            [
                'id'    => '103',
                'title' => 'sub_category_delete',
            ],
            [
                'id'    => '104',
                'title' => 'sub_category_access',
            ],
            [
                'id'    => '105',
                'title' => 'admin_setting_create',
            ],
            [
                'id'    => '106',
                'title' => 'admin_setting_edit',
            ],
            [
                'id'    => '107',
                'title' => 'admin_setting_show',
            ],
            [
                'id'    => '108',
                'title' => 'admin_setting_delete',
            ],
            [
                'id'    => '109',
                'title' => 'admin_setting_access',
            ],
            [
                'id'    => '110',
                'title' => 'un_used_access',
            ],
            [
                'id'    => '111',
                'title' => 'occasion_create',
            ],
            [
                'id'    => '112',
                'title' => 'occasion_edit',
            ],
            [
                'id'    => '113',
                'title' => 'occasion_show',
            ],
            [
                'id'    => '114',
                'title' => 'occasion_delete',
            ],
            [
                'id'    => '115',
                'title' => 'occasion_access',
            ],
            [
                'id'    => '116',
                'title' => 'email_subscription_create',
            ],
            [
                'id'    => '117',
                'title' => 'email_subscription_edit',
            ],
            [
                'id'    => '118',
                'title' => 'email_subscription_show',
            ],
            [
                'id'    => '119',
                'title' => 'email_subscription_delete',
            ],
            [
                'id'    => '120',
                'title' => 'email_subscription_access',
            ],
            [
                'id'    => '121',
                'title' => 'promo_code_create',
            ],
            [
                'id'    => '122',
                'title' => 'promo_code_edit',
            ],
            [
                'id'    => '123',
                'title' => 'promo_code_show',
            ],
            [
                'id'    => '124',
                'title' => 'promo_code_delete',
            ],
            [
                'id'    => '125',
                'title' => 'promo_code_access',
            ],
            [
                'id'    => '126',
                'title' => 'login_log_create',
            ],
            [
                'id'    => '127',
                'title' => 'login_log_edit',
            ],
            [
                'id'    => '128',
                'title' => 'login_log_show',
            ],
            [
                'id'    => '129',
                'title' => 'login_log_delete',
            ],
            [
                'id'    => '130',
                'title' => 'login_log_access',
            ],
            [
                'id'    => '131',
                'title' => 'payment_log_show',
            ],
            [
                'id'    => '132',
                'title' => 'payment_log_access',
            ],
            [
                'id'    => '133',
                'title' => 'payment_management_access',
            ],
            [
                'id'    => '134',
=======
                'title' => 'sub_category_delete',
            ],
            [
                'id'    => '92',
                'title' => 'sub_category_access',
            ],
            [
                'id'    => '93',
                'title' => 'admin_setting_create',
            ],
            [
                'id'    => '94',
                'title' => 'admin_setting_edit',
            ],
            [
                'id'    => '95',
                'title' => 'admin_setting_show',
            ],
            [
                'id'    => '96',
                'title' => 'admin_setting_delete',
            ],
            [
                'id'    => '97',
                'title' => 'admin_setting_access',
            ],
            [
                'id'    => '98',
                'title' => 'occasion_create',
            ],
            [
                'id'    => '99',
                'title' => 'occasion_edit',
            ],
            [
                'id'    => '100',
                'title' => 'occasion_show',
            ],
            [
                'id'    => '101',
                'title' => 'occasion_delete',
            ],
            [
                'id'    => '102',
                'title' => 'occasion_access',
            ],
            [
                'id'    => '103',
                'title' => 'email_subscription_create',
            ],
            [
                'id'    => '104',
                'title' => 'email_subscription_edit',
            ],
            [
                'id'    => '105',
                'title' => 'email_subscription_show',
            ],
            [
                'id'    => '106',
                'title' => 'email_subscription_delete',
            ],
            [
                'id'    => '107',
                'title' => 'email_subscription_access',
            ],
            [
                'id'    => '108',
                'title' => 'promo_code_create',
            ],
            [
                'id'    => '109',
                'title' => 'promo_code_edit',
            ],
            [
                'id'    => '110',
                'title' => 'promo_code_show',
            ],
            [
                'id'    => '111',
                'title' => 'promo_code_delete',
            ],
            [
                'id'    => '112',
                'title' => 'promo_code_access',
            ],
            [
                'id'    => '113',
                'title' => 'login_log_create',
            ],
            [
                'id'    => '114',
                'title' => 'login_log_edit',
            ],
            [
                'id'    => '115',
                'title' => 'login_log_show',
            ],
            [
                'id'    => '116',
                'title' => 'login_log_delete',
            ],
            [
                'id'    => '117',
                'title' => 'login_log_access',
            ],
            [
                'id'    => '118',
                'title' => 'payment_log_show',
            ],
            [
                'id'    => '119',
                'title' => 'payment_log_access',
            ],
            [
                'id'    => '120',
                'title' => 'payment_management_access',
            ],
            [
                'id'    => '121',
                'title' => 'artist_payment_history_show',
            ],
            [
                'id'    => '122',
                'title' => 'artist_payment_history_delete',
            ],
            [
                'id'    => '123',
                'title' => 'artist_payment_history_access',
            ],
            [
                'id'    => '124',
                'title' => 'agent_payment_history_show',
            ],
            [
                'id'    => '125',
                'title' => 'agent_payment_history_delete',
            ],
            [
                'id'    => '126',
                'title' => 'agent_payment_history_access',
            ],
            [
                'id'    => '127',
                'title' => 'artist_response_create',
            ],
            [
                'id'    => '128',
                'title' => 'artist_response_edit',
            ],
            [
                'id'    => '129',
                'title' => 'artist_response_show',
            ],
            [
                'id'    => '130',
                'title' => 'artist_response_delete',
            ],
            [
                'id'    => '131',
                'title' => 'artist_response_access',
            ],
            [
                'id'    => '132',
                'title' => 'agent_mangement_access',
            ],
            [
                'id'    => '133',
                'title' => 'agent_list_access',
            ],
            [
                'id'    => '134',
                'title' => 'agent_metum_create',
            ],
            [
                'id'    => '135',
                'title' => 'agent_metum_edit',
            ],
            [
                'id'    => '136',
                'title' => 'agent_metum_show',
            ],
            [
                'id'    => '137',
                'title' => 'agent_metum_delete',
            ],
            [
                'id'    => '138',
                'title' => 'agent_metum_access',
            ],
            [
                'id'    => '139',
                'title' => 'artist_management_access',
            ],
            [
                'id'    => '140',
                'title' => 'artist_list_access',
            ],
            [
                'id'    => '141',
                'title' => 'artist_metum_create',
            ],
            [
                'id'    => '142',
                'title' => 'artist_metum_edit',
            ],
            [
                'id'    => '143',
                'title' => 'artist_metum_show',
            ],
            [
                'id'    => '144',
                'title' => 'artist_metum_delete',
            ],
            [
                'id'    => '145',
                'title' => 'artist_metum_access',
            ],
            [
                'id'    => '146',
                'title' => 'customers_list_access',
            ],
            [
                'id'    => '147',
                'title' => 'user_metum_create',
            ],
            [
                'id'    => '148',
                'title' => 'user_metum_edit',
            ],
            [
                'id'    => '149',
                'title' => 'user_metum_show',
            ],
            [
                'id'    => '150',
                'title' => 'user_metum_delete',
            ],
            [
                'id'    => '151',
                'title' => 'user_metum_access',
            ],
            [
                'id'    => '152',
                'title' => 'user_wallet_history_show',
            ],
            [
                'id'    => '153',
                'title' => 'user_wallet_history_delete',
            ],
            [
                'id'    => '154',
                'title' => 'user_wallet_history_access',
            ],
            [
                'id'    => '155',
>>>>>>> quickadminpanel_2020_04_08_10_05_50
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}

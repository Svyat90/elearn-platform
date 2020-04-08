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
                'title' => 'search_log_show',
            ],
            [
                'id'    => '43',
                'title' => 'search_log_delete',
            ],
            [
                'id'    => '44',
                'title' => 'search_log_access',
            ],
            [
                'id'    => '45',
                'title' => 'social_medium_create',
            ],
            [
                'id'    => '46',
                'title' => 'social_medium_edit',
            ],
            [
                'id'    => '47',
                'title' => 'social_medium_show',
            ],
            [
                'id'    => '48',
                'title' => 'social_medium_delete',
            ],
            [
                'id'    => '49',
                'title' => 'social_medium_access',
            ],
            [
                'id'    => '50',
                'title' => 'content_management_access',
            ],
            [
                'id'    => '51',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '52',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '53',
                'title' => 'order_create',
            ],
            [
                'id'    => '54',
                'title' => 'order_edit',
            ],
            [
                'id'    => '55',
                'title' => 'order_show',
            ],
            [
                'id'    => '56',
                'title' => 'order_delete',
            ],
            [
                'id'    => '57',
                'title' => 'order_access',
            ],
            [
                'id'    => '58',
                'title' => 'video_create',
            ],
            [
                'id'    => '59',
                'title' => 'video_edit',
            ],
            [
                'id'    => '60',
                'title' => 'video_show',
            ],
            [
                'id'    => '61',
                'title' => 'video_delete',
            ],
            [
                'id'    => '62',
                'title' => 'video_access',
            ],
            [
                'id'    => '63',
                'title' => 'user_review_create',
            ],
            [
                'id'    => '64',
                'title' => 'user_review_edit',
            ],
            [
                'id'    => '65',
                'title' => 'user_review_show',
            ],
            [
                'id'    => '66',
                'title' => 'user_review_delete',
            ],
            [
                'id'    => '67',
                'title' => 'user_review_access',
            ],
            [
                'id'    => '68',
                'title' => 'gender_create',
            ],
            [
                'id'    => '69',
                'title' => 'gender_edit',
            ],
            [
                'id'    => '70',
                'title' => 'gender_show',
            ],
            [
                'id'    => '71',
                'title' => 'gender_delete',
            ],
            [
                'id'    => '72',
                'title' => 'gender_access',
            ],
            [
                'id'    => '73',
                'title' => 'order_payment_show',
            ],
            [
                'id'    => '74',
                'title' => 'order_payment_delete',
            ],
            [
                'id'    => '75',
                'title' => 'order_payment_access',
            ],
            [
                'id'    => '76',
                'title' => 'orders_list_access',
            ],
            [
                'id'    => '77',
                'title' => 'customer_management_access',
            ],
            [
                'id'    => '78',
                'title' => 'admin_user_create',
            ],
            [
                'id'    => '79',
                'title' => 'admin_user_edit',
            ],
            [
                'id'    => '80',
                'title' => 'admin_user_show',
            ],
            [
                'id'    => '81',
                'title' => 'admin_user_delete',
            ],
            [
                'id'    => '82',
                'title' => 'admin_user_access',
            ],
            [
                'id'    => '83',
                'title' => 'media_management_access',
            ],
            [
                'id'    => '84',
                'title' => 'site_log_access',
            ],
            [
                'id'    => '85',
                'title' => 'site_management_access',
            ],
            [
                'id'    => '86',
                'title' => 'sub_category_create',
            ],
            [
                'id'    => '87',
                'title' => 'sub_category_edit',
            ],
            [
                'id'    => '88',
                'title' => 'sub_category_show',
            ],
            [
                'id'    => '89',
                'title' => 'sub_category_delete',
            ],
            [
                'id'    => '90',
                'title' => 'sub_category_access',
            ],
            [
                'id'    => '91',
                'title' => 'admin_setting_edit',
            ],
            [
                'id'    => '92',
                'title' => 'admin_setting_show',
            ],
            [
                'id'    => '93',
                'title' => 'admin_setting_access',
            ],
            [
                'id'    => '94',
                'title' => 'occasion_create',
            ],
            [
                'id'    => '95',
                'title' => 'occasion_edit',
            ],
            [
                'id'    => '96',
                'title' => 'occasion_show',
            ],
            [
                'id'    => '97',
                'title' => 'occasion_delete',
            ],
            [
                'id'    => '98',
                'title' => 'occasion_access',
            ],
            [
                'id'    => '99',
                'title' => 'email_subscription_create',
            ],
            [
                'id'    => '100',
                'title' => 'email_subscription_edit',
            ],
            [
                'id'    => '101',
                'title' => 'email_subscription_show',
            ],
            [
                'id'    => '102',
                'title' => 'email_subscription_delete',
            ],
            [
                'id'    => '103',
                'title' => 'email_subscription_access',
            ],
            [
                'id'    => '104',
                'title' => 'promo_code_create',
            ],
            [
                'id'    => '105',
                'title' => 'promo_code_edit',
            ],
            [
                'id'    => '106',
                'title' => 'promo_code_show',
            ],
            [
                'id'    => '107',
                'title' => 'promo_code_delete',
            ],
            [
                'id'    => '108',
                'title' => 'promo_code_access',
            ],
            [
                'id'    => '109',
                'title' => 'login_log_show',
            ],
            [
                'id'    => '110',
                'title' => 'login_log_delete',
            ],
            [
                'id'    => '111',
                'title' => 'login_log_access',
            ],
            [
                'id'    => '112',
                'title' => 'payment_log_show',
            ],
            [
                'id'    => '113',
                'title' => 'payment_log_access',
            ],
            [
                'id'    => '114',
                'title' => 'payment_management_access',
            ],
            [
                'id'    => '115',
                'title' => 'artist_payment_history_show',
            ],
            [
                'id'    => '116',
                'title' => 'artist_payment_history_delete',
            ],
            [
                'id'    => '117',
                'title' => 'artist_payment_history_access',
            ],
            [
                'id'    => '118',
                'title' => 'agent_payment_history_show',
            ],
            [
                'id'    => '119',
                'title' => 'agent_payment_history_delete',
            ],
            [
                'id'    => '120',
                'title' => 'agent_payment_history_access',
            ],
            [
                'id'    => '121',
                'title' => 'artist_response_create',
            ],
            [
                'id'    => '122',
                'title' => 'artist_response_edit',
            ],
            [
                'id'    => '123',
                'title' => 'artist_response_show',
            ],
            [
                'id'    => '124',
                'title' => 'artist_response_delete',
            ],
            [
                'id'    => '125',
                'title' => 'artist_response_access',
            ],
            [
                'id'    => '126',
                'title' => 'agent_mangement_access',
            ],
            [
                'id'    => '127',
                'title' => 'agent_list_access',
            ],
            [
                'id'    => '128',
                'title' => 'agent_metum_create',
            ],
            [
                'id'    => '129',
                'title' => 'agent_metum_edit',
            ],
            [
                'id'    => '130',
                'title' => 'agent_metum_show',
            ],
            [
                'id'    => '131',
                'title' => 'agent_metum_delete',
            ],
            [
                'id'    => '132',
                'title' => 'agent_metum_access',
            ],
            [
                'id'    => '133',
                'title' => 'artist_management_access',
            ],
            [
                'id'    => '134',
                'title' => 'artist_list_access',
            ],
            [
                'id'    => '135',
                'title' => 'artist_metum_create',
            ],
            [
                'id'    => '136',
                'title' => 'artist_metum_edit',
            ],
            [
                'id'    => '137',
                'title' => 'artist_metum_show',
            ],
            [
                'id'    => '138',
                'title' => 'artist_metum_delete',
            ],
            [
                'id'    => '139',
                'title' => 'artist_metum_access',
            ],
            [
                'id'    => '140',
                'title' => 'customers_list_access',
            ],
            [
                'id'    => '141',
                'title' => 'user_metum_create',
            ],
            [
                'id'    => '142',
                'title' => 'user_metum_edit',
            ],
            [
                'id'    => '143',
                'title' => 'user_metum_show',
            ],
            [
                'id'    => '144',
                'title' => 'user_metum_delete',
            ],
            [
                'id'    => '145',
                'title' => 'user_metum_access',
            ],
            [
                'id'    => '146',
                'title' => 'user_wallet_history_show',
            ],
            [
                'id'    => '147',
                'title' => 'user_wallet_history_delete',
            ],
            [
                'id'    => '148',
                'title' => 'user_wallet_history_access',
            ],
            [
                'id'    => '149',
                'title' => 'artist_enquiry_create',
            ],
            [
                'id'    => '150',
                'title' => 'artist_enquiry_edit',
            ],
            [
                'id'    => '151',
                'title' => 'artist_enquiry_show',
            ],
            [
                'id'    => '152',
                'title' => 'artist_enquiry_delete',
            ],
            [
                'id'    => '153',
                'title' => 'artist_enquiry_access',
            ],
            [
                'id'    => '154',
                'title' => 'user_profile_avatar_image_access',
            ],
            [
                'id'    => '155',
                'title' => 'talent_profile_image_access',
            ],
            [
                'id'    => '156',
                'title' => 'talent_profile_intro_video_access',
            ],
            [
                'id'    => '157',
                'title' => 'user_wishlist_create',
            ],
            [
                'id'    => '158',
                'title' => 'user_wishlist_edit',
            ],
            [
                'id'    => '159',
                'title' => 'user_wishlist_show',
            ],
            [
                'id'    => '160',
                'title' => 'user_wishlist_delete',
            ],
            [
                'id'    => '161',
                'title' => 'user_wishlist_access',
            ],
            [
                'id'    => '162',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}

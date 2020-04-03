<?php

return [
    'userManagement'     => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'         => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'               => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'               => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                           => 'ID',
            'id_helper'                    => '',
            'name'                         => 'Name',
            'name_helper'                  => '',
            'email'                        => 'Email',
            'email_helper'                 => '',
            'email_verified_at'            => 'Email verified at',
            'email_verified_at_helper'     => '',
            'password'                     => 'Password',
            'password_helper'              => '',
            'roles'                        => 'Roles',
            'roles_helper'                 => '',
            'remember_token'               => 'Remember Token',
            'remember_token_helper'        => '',
            'created_at'                   => 'Created at',
            'created_at_helper'            => '',
            'updated_at'                   => 'Updated at',
            'updated_at_helper'            => '',
            'deleted_at'                   => 'Deleted at',
            'deleted_at_helper'            => '',
            'first_name'                   => 'First Name',
            'first_name_helper'            => '',
            'last_name'                    => 'Last Name',
            'last_name_helper'             => '',
            'dob'                          => 'Date of birth',
            'dob_helper'                   => '',
            'position_occupation'          => 'Position/Occupation',
            'position_occupation_helper'   => '',
            'subscribers'                  => 'Nr of subs',
            'subscribers_helper'           => 'Number of subscribers',
            'bio'                          => 'BIO',
            'bio_helper'                   => '',
            'language'                     => 'Languages',
            'language_helper'              => '',
            'country'                      => 'Country',
            'country_helper'               => '',
            'social_meidia'                => 'Social Meidias',
            'social_meidia_helper'         => '',
            'category'                     => 'Categories',
            'category_helper'              => '',
            'gender'                       => 'Gender',
            'gender_helper'                => '',
            'referral_code'                => 'Referral Code',
            'referral_code_helper'         => '',
            'referred_by'                  => 'Referred By',
            'referred_by_helper'           => '',
            'registration_platform'        => 'Registration Platform',
            'registration_platform_helper' => '',
            'image'                        => 'Image',
            'image_helper'                 => '',
            'status'                       => 'Status',
            'status_helper'                => '',
        ],
    ],
    'category'           => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'image'             => 'Image',
            'image_helper'      => '',
        ],
    ],
    'country'            => [
        'title'          => 'Countries',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'short_code'        => 'Short Code',
            'short_code_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'language'           => [
        'title'          => 'Languages',
        'title_singular' => 'Language',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'tag'                => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'page'               => [
        'title'          => 'Content',
        'title_singular' => 'Content',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'text'              => 'Content',
            'text_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'searchLog'          => [
        'title'          => 'Search Logs',
        'title_singular' => 'Search Log',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'term'              => 'Term',
            'term_helper'       => '',
            'page'              => 'Page',
            'page_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'socialMedium'       => [
        'title'          => 'Social Medias',
        'title_singular' => 'Social Media',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'short_code'        => 'Short Code',
            'short_code_helper' => '',
        ],
    ],
    'referralCommission' => [
        'title'          => 'Referral Commission',
        'title_singular' => 'Referral Commission',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'user_commission'          => 'User Commission',
            'user_commission_helper'   => '',
            'artist_commission'        => 'Artist Commission',
            'artist_commission_helper' => '',
            'agent_commission'         => 'Agent Commission',
            'agent_commission_helper'  => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],
    'contentManagement'  => [
        'title'          => 'Content Management',
        'title_singular' => 'Content Management',
    ],
    'auditLog'           => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => '',
            'description'         => 'Description',
            'description_helper'  => '',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => '',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => '',
            'user_id'             => 'User ID',
            'user_id_helper'      => '',
            'properties'          => 'Properties',
            'properties_helper'   => '',
            'host'                => 'Host',
            'host_helper'         => '',
            'created_at'          => 'Created at',
            'created_at_helper'   => '',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => '',
        ],
    ],
    'order'              => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'video'                 => 'Video',
            'video_helper'          => '',
            'created_at'            => 'Created at',
            'created_at_helper'     => '',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => '',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => '',
            'user'                  => 'User',
            'user_helper'           => '',
            'payment_status'        => 'Payment Status',
            'payment_status_helper' => '',
            'order_status'          => 'Order Status',
            'order_status_helper'   => '',
            'message'               => 'Message',
            'message_helper'        => '',
            'payment_info'          => 'Payment Info',
            'payment_info_helper'   => '',
            'total'                 => 'Total',
            'total_helper'          => '',
        ],
    ],
    'video'              => [
        'title'          => 'Videos',
        'title_singular' => 'Video',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'text'              => 'Description',
            'text_helper'       => '',
            'file'              => 'File',
            'file_helper'       => '',
            'user'              => 'User',
            'user_helper'       => '',
            'status'            => 'Status',
            'status_helper'     => '',
        ],
    ],
    'userReview'         => [
        'title'          => 'User Reviews',
        'title_singular' => 'User Review',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'text'              => 'Content',
            'text_helper'       => '',
            'stars'             => 'Stars',
            'stars_helper'      => '',
            'video'             => 'Video',
            'video_helper'      => '',
            'user'              => 'User',
            'user_helper'       => '',
        ],
    ],
    'gender'             => [
        'title'          => 'Gender',
        'title_singular' => 'Gender',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'orderHistory'       => [
        'title'          => 'Order History',
        'title_singular' => 'Order History',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'user'              => 'User',
            'user_helper'       => '',
            'video'             => 'Video',
            'video_helper'      => '',
            'comment'           => 'Comment',
            'comment_helper'    => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'orderPayment'       => [
        'title'          => 'Order Payments',
        'title_singular' => 'Order Payment',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'order'             => 'Order',
            'order_helper'      => '',
            'amount'            => 'Amount',
            'amount_helper'     => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'address'           => 'Address',
            'address_helper'    => '',
            'phone'             => 'Phone',
            'phone_helper'      => '',
            'text'              => 'Description',
            'text_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'ordersList'         => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
    ],
];

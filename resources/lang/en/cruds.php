<?php

return [
    'userManagement'               => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'                   => [
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
    'role'                         => [
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
    'user'                         => [
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
            'roles_helper'                 => '1 - Customer 2 - Celebrity 3 - Agent',
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
            'country'                      => 'Country',
            'country_helper'               => '',
            'gender'                       => 'Gender',
            'gender_helper'                => '',
            'referral_code'                => 'Referral Code',
            'referral_code_helper'         => 'user unique code which they can use to refer new user',
            'referred_by'                  => 'Referred By',
            'referred_by_helper'           => '',
            'registration_platform'        => 'Registration Platform',
            'registration_platform_helper' => '',
            'mobile_no'                    => 'Mobile No',
            'mobile_no_helper'             => '',
            'ig_token'                     => 'Ig Token',
            'ig_token_helper'              => 'Instagram login access token',
            'ig_username'                  => 'Ig Username',
            'ig_username_helper'           => 'Instagram Username',
            'user_status'                  => 'User Status',
            'user_status_helper'           => 'Active, Not Active, Banned, Deleted',
            'birth_date'                   => 'Birth Date',
            'birth_date_helper'            => '',
            'avatar'                       => 'avatar',
            'avatar_helper'                => '',
            'registration_source'          => 'Registration Source',
            'registration_source_helper'   => 'manual form or instagram',
            'registered_on'                => 'Registered On',
            'registered_on_helper'         => '',
            'position'                     => 'Position',
            'institution'                  => 'Institution',
            'phone'                        => 'Phone',
        ],
    ],
    'category'                     => [
        'title'          => 'Main Categories',
        'title_singular' => 'Main Category',
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
            'color'             => 'Color',
            'color_helper'      => '',
            'access'            => 'Access',
            'access_helper'     => 'public - show all, protected - show only who may access, private - not show',
        ],
    ],
    'contentManagement'            => [
        'title'          => 'Content Management',
        'title_singular' => 'Content Management',
    ],
    'auditLog'                     => [
        'title'          => 'Logs',
        'title_singular' => 'Log',
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
    'subCategory'                  => [
        'title'          => 'Sub Categories',
        'title_singular' => 'Sub Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'color'             => 'Color',
            'color_helper'      => '',
            'image'             => 'Image',
            'image_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'parent'            => 'Parent',
            'parent_helper'     => '',
            'access'            => 'Access',
            'access_helper'     => 'public - show all, protected - show only who may access, private - not show',
            'parent_name'       => 'Parent name',
        ],
    ],
    'adminSetting'                 => [
        'title'          => 'Site Settings',
        'title_singular' => 'Site Setting',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'key'               => 'Key',
            'key_helper'        => '',
            'value'             => 'Value',
            'value_helper'      => '',
        ],
    ],
    'document'                     => [
        'title'          => 'Documents',
        'title_singular' => 'Document',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'name_ru'              => 'Name (ru)',
            'name_ru_helper'       => '',
            'name_ro'              => 'Name (ro)',
            'name_ro_helper'       => '',
            'name_en'              => 'Name (en)',
            'name_en_helper'       => '',
            'name_issuer'       => 'Issuer Name',
            'name_issuer_helper'=> '',
            'name_issuer_ru'       => 'Issuer Name (ru)',
            'name_issuer_ru_helper'=> '',
            'name_issuer_ro'       => 'Issuer Name (ro)',
            'name_issuer_ro_helper'=> '',
            'name_issuer_en'       => 'Issuer Name (en)',
            'name_issuer_en_helper'=> '',
            'topic'             => 'Topic',
            'topic_helper'      => '',
            'topic_ru'             => 'Topic (ru)',
            'topic_ru_helper'      => '',
            'topic_ro'             => 'Topic (ro)',
            'topic_ro_helper'      => '',
            'topic_en'             => 'Topic (en)',
            'topic_en_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'approved_at'        => 'Approved at',
            'approved_at_helper' => '',
            'published_at'       => 'Published at',
            'published_at_helper'=> '',
            'image'             => 'Image',
            'image_helper'      => '',
            'access'            => 'Access',
            'access_helper'     => 'public - show all, protected - show only who may access, private - not show',
            'type'              => 'Type',
            'type_helper'       => '',
            'status'            => 'Status',
            'status_helper'     => '',
            'number'            => 'Number',
            'number_helper'     => '',
            'description'       => 'Description',
            'description_helper'=> '',
            'file'              => 'File (PDF)',
            'file_helper'       => '',
        ],
    ],
];

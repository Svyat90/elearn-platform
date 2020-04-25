<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTwo extends Model
{
    public $table = 'users';

    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'registered_on',
        'email_verified_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'ig_token',
        'password',
        'last_name',
        'mobile_no',
        'gender_id',
        'updated_at',
        'created_at',
        'birth_date',
        'deleted_at',
        'first_name',
        'country_id',
        'ig_username',
        'user_status',
        'referred_by',
        'referral_code',
        'registered_on',
        'remember_token',
        'email_verified_at',
        'registration_source',
        'registration_platform',
    ];
}

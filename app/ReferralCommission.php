<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    public $table = 'referral_commissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'user_commission',
        'agent_commission',
        'artist_commission',
    ];
}

<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use Auditable;

    public $table = 'admin_settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'company_commission',
        'referral_user_commision',
        'referal_agent_commision',
        'referal_artist_commision',
        'artist_video_show_count_web',
        'artist_video_show_count_app',
    ];
}

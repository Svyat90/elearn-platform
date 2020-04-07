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
        'user_commission',
        'agent_commission',
        'artist_commission',
    ];
}

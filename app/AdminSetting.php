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
        'key',
        'value',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

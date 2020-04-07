<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    public $table = 'login_logs';

    const LOGIN_FROM_SELECT = [
        '1' => 'Web',
        '2' => 'App',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'device',
        'user_id',
        'ip_address',
        'login_from',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}

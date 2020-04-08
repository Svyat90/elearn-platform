<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'admin_users';

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Not Active',
    ];

    protected $fillable = [
        'email',
        'status',
        'role_id',
        'username',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');

    }
}

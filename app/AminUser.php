<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AminUser extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'amin_users';

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'username',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

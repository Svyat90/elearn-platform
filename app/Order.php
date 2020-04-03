<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Auditable;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'video',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

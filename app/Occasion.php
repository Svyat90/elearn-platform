<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    use Auditable;

    public $table = 'occasions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function occasionTypeOrders()
    {
        return $this->hasMany(Order::class, 'occasion_type_id', 'id');

    }
}

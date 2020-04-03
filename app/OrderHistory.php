<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use Auditable;

    public $table = 'order_histories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Approved',
        '2' => 'Declined',
    ];

    protected $fillable = [
        'status',
        'user_id',
        'comment',
        'order_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);

    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');

    }
}

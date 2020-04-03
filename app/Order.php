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

    const PAYMENT_STATUS_SELECT = [
        '1' => 'Unpaid',
        '2' => 'Paid',
        '3' => 'Rjected',
    ];

    const ORDER_STATUS_SELECT = [
        '1' => 'New',
        '2' => 'Processing',
        '3' => 'Approved',
        '4' => 'Done',
    ];

    protected $fillable = [
        'total',
        'user_id',
        'message',
        'video_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'payment_info',
        'order_status',
        'payment_status',
    ];

    public function orderOrderPayments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id', 'id');

    }

    public function orderOrderHistories()
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');

    }
}

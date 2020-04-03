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
        '0' => 'Unpaid',
        '1' => 'Paid',
        '2' => 'Rjected',
    ];

    const ORDER_STATUS_SELECT = [
        '0' => 'New',
        '1' => 'Done',
        '2' => 'Processing',
        '3' => 'Approved',
    ];

    protected $fillable = [
        'video',
        'total',
        'user_id',
        'message',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}

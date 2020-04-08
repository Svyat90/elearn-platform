<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use Auditable;

    public $table = 'order_payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PAYMENT_STATUS_SELECT = [
        '1' => 'Completed',
        '2' => 'Failed',
    ];

    const PAYMENT_BY_SELECT = [
        '1' => 'Wallet',
        '2' => 'Payment gateway',
    ];

    protected $fillable = [
        'order_id',
        'pg_txnid',
        'payment_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'booking_amount',
        'payment_status',
        'recieved_amount',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');

    }
}

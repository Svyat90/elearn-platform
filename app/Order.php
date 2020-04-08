<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Auditable;

    public $table = 'orders';

    const ORDER_STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Rejected',
    ];

    const PAYMENT_STATUS_SELECT = [
        '1' => 'Completed',
        '2' => 'Failed',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'booking_datetime',
    ];

    const PAYMENT_BY_SELECT = [
        '1' => 'Payment gateway',
        '2' => 'Website wallet',
    ];

    protected $fillable = [
        'user_id',
        'message',
        'video_to',
        'video_for',
        'to_gender',
        'updated_at',
        'created_at',
        'payment_by',
        'promo_code',
        'hide_video',
        'deleted_at',
        'video_from',
        'from_gender',
        'language_id',
        'order_status',
        'customer_name',
        'delivery_phone',
        'promo_discount',
        'booking_amount',
        'payment_status',
        'delivery_email',
        'occasion_type_id',
        'booking_datetime',
    ];

    public function orderOrderPayments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id', 'id');

    }

    public function orderPaymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'order_id', 'id');

    }

    public function orderArtistResponses()
    {
        return $this->hasMany(ArtistResponse::class, 'order_id', 'id');

    }

    public function orderPaymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'order_id', 'id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');

    }

    public function occasion_type()
    {
        return $this->belongsTo(Occasion::class, 'occasion_type_id');

    }

    public function getBookingDatetimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setBookingDatetimeAttribute($value)
    {
        $this->attributes['booking_datetime'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }
}

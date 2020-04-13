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

    const VIDEO_FOR_SELECT = [
        '1' => 'myself',
        '2' => 'someone else',
    ];

    const PAYMENT_STATUS_SELECT = [
        '1' => 'Completed',
        '2' => 'Failed',
    ];

    const VIDEO_FROM_SELECT = [
        '1' => 'Myself',
        '2' => 'Customer name',
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

    const HIDE_VIDEO_SELECT = [
        '1' => 'Show on artist profile',
        '2' => 'Hide on artist profile',
    ];

    protected $fillable = [
        'user_id',
        'message',
        'video_to',
        'to_gender',
        'video_for',
        'artist_id',
        'updated_at',
        'created_at',
        'hide_video',
        'video_from',
        'payment_by',
        'deleted_at',
        'promo_code',
        'from_gender',
        'language_id',
        'order_status',
        'customer_name',
        'booking_amount',
        'delivery_phone',
        'delivery_email',
        'payment_status',
        'promo_discount',
        'booking_datetime',
        'occasion_type_id',
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

    public function artist()
    {
        return $this->belongsTo(ArtistMetum::class, 'artist_id');

    }
}
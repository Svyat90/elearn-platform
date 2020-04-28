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
        '1' => 'Pending',// When new order arrive it default marked as pending
        '2' => 'Accepted',// When Artist Accept the Order It marked As Accepted
        '3' => 'Completed', // When Artist Upload Video Then Order will be marked as Completed
        '4' => 'Rejected', // When Artist Reject The Order Then it will be marked as rejected
        '5' => 'Cancelled', // When User or Admin Cancelled Order It will Marked As Cancelled
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
        'booking_datetime',
        'created_at',
        'updated_at',
        'deleted_at',
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
        'order_note',
        'payment_status',
        'language_id',
        'from_gender',
        'video_to',
        'to_gender',
        'customer_name',
        'occasion_type_id',
        'delivery_email',
        'delivery_phone',
        'promo_code',
        'promo_discount',
        'booking_amount',
        'booking_datetime',
        'payment_by',
        'order_status',
        'artist_id',
        'video_for',
        'video_from',
        'hide_video',
        'order_id',
        'order_pin',
        'created_at',
        'updated_at',
        'deleted_at',
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

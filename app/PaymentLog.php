<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class PaymentLog extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'payment_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'amount',
        'user_id',
        'order_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'payment_info',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');

    }
}

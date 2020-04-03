<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Video extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'videos';

    protected $appends = [
        'file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Not Approved',
        '2' => 'Approved',
        '3' => 'Declined',
    ];

    protected $fillable = [
        'name',
        'text',
        'status',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function videoUserReviews()
    {
        return $this->hasMany(UserReview::class, 'video_id', 'id');

    }

    public function videoOrders()
    {
        return $this->hasMany(Order::class, 'video_id', 'id');

    }

    public function videoOrderHistories()
    {
        return $this->belongsToMany(OrderHistory::class);

    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->last();

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}

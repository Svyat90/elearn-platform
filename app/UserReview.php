<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class UserReview extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'user_reviews';

    const SHOW_VIDEO_RADIO = [
        '1' => 'Show',
        '0' => 'Hide',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const REVIEW_APPORVAL_SELECT = [
        '1' => 'Pending',
        '2' => 'Approved',
        '3' => 'Not approved',
    ];

    protected $fillable = [
        'text',
        'stars',
        'video_id',
        'show_video',
        'created_at',
        'updated_at',
        'deleted_at',
        'review_text',
        'review_apporval',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');

    }
}

<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ArtistMetum extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'artist_meta';

    protected $appends = [
        'intro_video_url',
        'profile_photo_url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ARTIST_STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Active',
        '3' => 'Not Active',
    ];

    protected $fillable = [
        'url_name',
        'artist_id',
        'updated_at',
        'created_at',
        'deleted_at',
        'artist_fee',
        'display_name',
        'profile_info',
        'artist_status',
        'social_twitch',
        'social_tiktok',
        'social_youtube',
        'social_twitter',
        'social_snapchat',
        'sub_category_id',
        'social_linkedin',
        'social_facebook',
        'social_instagram',
        'main_catogery_id',
        'artist_commission',
        'order_status_email',
        'company_commission',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function artistOrders()
    {
        return $this->hasMany(Order::class, 'artist_id', 'id');

    }

    public function artistArtistResponses()
    {
        return $this->hasMany(ArtistResponse::class, 'artist_id', 'id');

    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');

    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);

    }

    public function main_catogery()
    {
        return $this->belongsTo(Category::class, 'main_catogery_id');

    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);

    }

    public function getProfilePhotoUrlAttribute()
    {
        $file = $this->getMedia('profile_photo_url')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

    public function getIntroVideoUrlAttribute()
    {
        return $this->getMedia('intro_video_url')->last();

    }

}

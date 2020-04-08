<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ArtistEnquiry extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'artist_enquiries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Inprocess',
        '3' => 'Completed',
    ];

    protected $fillable = [
        'note',
        'name',
        'email',
        'status',
        'artist_id',
        'contact_no',
        'country_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'social_media',
        'social_media_type',
        'social_media_followrs',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function artist()
    {
        return $this->belongsTo(User::class, 'artist_id');

    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');

    }
}

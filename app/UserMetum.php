<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class UserMetum extends Model implements HasMedia
{
    use HasMediaTrait, Auditable;

    public $table = 'user_meta';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'bio',
        'wallet_balance',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function wishlists()
    {
        return $this->belongsToMany(User::class);

    }

    public function userlikelists()
    {
        return $this->belongsToMany(UserTwo::class);

    }

}

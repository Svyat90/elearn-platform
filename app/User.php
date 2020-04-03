<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasApiTokens, HasMediaTrait, Auditable;

    public $table = 'users';

    protected $appends = [
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    const REGISTRATION_PLATFORM_SELECT = [
        '1' => 'Web',
        '2' => 'App',
    ];

    const STATUS_SELECT = [
        '0' => 'NotActive',
        '1' => 'Active',
        '2' => 'Banned',
    ];

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'bio',
        'dob',
        'name',
        'email',
        'status',
        'password',
        'gender_id',
        'last_name',
        'updated_at',
        'created_at',
        'country_id',
        'deleted_at',
        'first_name',
        'referred_by',
        'subscribers',
        'referral_code',
        'remember_token',
        'email_verified_at',
        'position_occupation',
        'registration_platform',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function userUserReviews()
    {
        return $this->hasMany(UserReview::class, 'user_id', 'id');

    }

    public function userOrders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');

    }

    public function userVideos()
    {
        return $this->hasMany(Video::class, 'user_id', 'id');

    }

    public function userOrderHistories()
    {
        return $this->hasMany(OrderHistory::class, 'user_id', 'id');

    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }

    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));

    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);

    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');

    }

    public function social_meidias()
    {
        return $this->belongsToMany(SocialMedium::class);

    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);

    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');

    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

}

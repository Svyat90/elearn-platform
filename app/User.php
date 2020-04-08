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
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    const REGISTRATION_PLATFORM_SELECT = [
        '1' => 'Web',
        '2' => 'App',
    ];

    const REGISTRATION_SOURCE_SELECT = [
        '1' => 'Manual form',
        '2' => 'Instagram',
    ];

    const USER_STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Not Active',
        '3' => 'Banned',
        '4' => 'Deleted',
    ];

    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'registered_on',
        'email_verified_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'ig_token',
        'password',
        'last_name',
        'mobile_no',
        'gender_id',
        'updated_at',
        'created_at',
        'birth_date',
        'deleted_at',
        'first_name',
        'country_id',
        'ig_username',
        'user_status',
        'referred_by',
        'referral_code',
        'registered_on',
        'remember_token',
        'email_verified_at',
        'registration_source',
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

    public function userOrders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');

    }

    public function userVideos()
    {
        return $this->hasMany(Video::class, 'user_id', 'id');

    }

    public function userLoginLogs()
    {
        return $this->hasMany(LoginLog::class, 'user_id', 'id');

    }

    public function userPaymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'user_id', 'id');

    }

    public function userArtistPaymentHistories()
    {
        return $this->hasMany(ArtistPaymentHistory::class, 'user_id', 'id');

    }

    public function earnFromArtistPaymentHistories()
    {
        return $this->hasMany(ArtistPaymentHistory::class, 'earn_from_id', 'id');

    }

    public function userAgentPaymentHistories()
    {
        return $this->hasMany(AgentPaymentHistory::class, 'user_id', 'id');

    }

    public function earnFromAgentPaymentHistories()
    {
        return $this->hasMany(AgentPaymentHistory::class, 'earn_from_id', 'id');

    }

    public function userAgentMeta()
    {
        return $this->hasMany(AgentMetum::class, 'user_id', 'id');

    }

    public function artistArtistMeta()
    {
        return $this->hasMany(ArtistMetum::class, 'artist_id', 'id');

    }

    public function userUserMeta()
    {
        return $this->hasMany(UserMetum::class, 'user_id', 'id');

    }

    public function userUserWalletHistories()
    {
        return $this->hasMany(UserWalletHistory::class, 'user_id', 'id');

    }

    public function earnFromUserWalletHistories()
    {
        return $this->hasMany(UserWalletHistory::class, 'earn_from_id', 'id');

    }

    public function artistArtistEnquiries()
    {
        return $this->hasMany(ArtistEnquiry::class, 'artist_id', 'id');

    }

    public function agentAgentMeta()
    {
        return $this->hasMany(AgentMetum::class, 'agent_id', 'id');

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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');

    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');

    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getAvatarAttribute()
    {
        $file = $this->getMedia('avatar')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

    public function getRegisteredOnAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setRegisteredOnAttribute($value)
    {
        $this->attributes['registered_on'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

}

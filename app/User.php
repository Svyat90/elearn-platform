<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Auditable;

    public $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    const USER_STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'Not Active',
        '3' => 'Banned',
        '4' => 'Deleted',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'user_status',
        'position',
        'institution',
        'phone',
        'remember_token',
        'email_verified_at',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getCurrRole()
    {
        return $this->name;
    }

    /*
     * Filter users by Role
     */
    public function scopeByRole($query,$role)
    {
        return $query->leftJoin('role_user','role_user.user_id','=','users.id')
            ->where('role_user.role_id', $role);
    }

    /*
      * Fron user Role
      */
    public function scopeIsFrontUsersRole($query)
    {
        return $query->leftJoin('role_user','role_user.user_id','=','users.id')
            ->where('role_user.role_id', 2)
            ->orWhere('role_user.role_id', 3)
            ->orWhere('role_user.role_id', 4);
    }

    /*
     * User/Customer Role
     * IsUserRole
     */
    public function scopeIsUserRole($query)
    {
        return $query->leftJoin('role_user','role_user.user_id','=','users.id')
            ->where('role_user.role_id', 2);

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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

    /**
     * @return BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

}

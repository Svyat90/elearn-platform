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
        self::USER_STATUS_ACTIVE => 'Active',
        self::USER_STATUS_NOT_ACTIVE => 'Not Active',
        '3' => 'Banned',
        '4' => 'Deleted',
    ];

    const USER_STATUS_ACTIVE = '1';
    const USER_STATUS_NOT_ACTIVE = '2';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'email', 'password', 'first_name', 'last_name',
        'user_status', 'position', 'institution', 'phone', 'remember_token',
        'email_verified_at', 'updated_at', 'created_at', 'deleted_at',
    ];

    protected $casts = [
        'force_logout' => 'bool'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * @return BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_user', 'user_id', 'document_id');
    }

    /**
     * @return BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user', 'user_id', 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'sub_category_user', 'user_id', 'sub_category_id');
    }

}

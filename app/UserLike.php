<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    public $table = 'user_likes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'video_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function scopeWithUser($query)
    {
        return $query->leftJoin('users','users.id','=','user_likes.user_id');

    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');

    }
}

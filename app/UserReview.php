<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use Auditable;

    public $table = 'user_reviews';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'text',
        'stars',
        'user_id',
        'video_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}

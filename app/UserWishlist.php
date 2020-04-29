<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class UserWishlist extends Model
{
    use Auditable;

    public $table = 'user_wishlists';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'artist_id',
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
        return $query->leftJoin('users','users.id','=','user_wishlists.user_id');

    }


    public function artist()
    {
        return $this->belongsTo(ArtistMetum::class, 'artist_id');

    }
}

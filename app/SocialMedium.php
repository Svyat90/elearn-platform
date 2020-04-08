<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class SocialMedium extends Model
{
    use Auditable;

    public $table = 'social_media';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'website',
        'short_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function socialMeidiaUsers()
    {
        return $this->belongsToMany(User::class);

    }
}

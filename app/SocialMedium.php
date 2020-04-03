<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedium extends Model
{
    public $table = 'social_media';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'short_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

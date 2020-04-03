<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    public $table = 'user_languages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);

    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);

    }
}

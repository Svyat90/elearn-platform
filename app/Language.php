<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $table = 'languages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function languageUsers()
    {
        return $this->belongsToMany(User::class);

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'countries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'short_code',
        'phone_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function countryUsers()
    {
        return $this->hasMany(User::class, 'country_id', 'id');

    }
}

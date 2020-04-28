<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use Auditable;

    public $table = 'languages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'iso_code',
        'native_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function languageOrders()
    {
        return $this->hasMany(Order::class, 'language_id', 'id');

    }

    public function languagesArtistMeta()
    {
        return $this->belongsToMany(ArtistMetum::class);

    }
}

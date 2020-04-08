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
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function languageUsers()
    {
        return $this->belongsToMany(User::class);

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return BelongsToMany
     */
    public function rolesUsers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @return BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

}

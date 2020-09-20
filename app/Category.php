<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_ru',
        'name_ro',
        'name_en',
        'access',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parentSubCategories()
    {
        return $this->hasMany(SubCategory::class, 'parent_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_category', 'category_id', 'document_id');
    }

}

<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'sub_categories';

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
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

}

<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'courses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_at'
    ];

    protected $fillable = [
        'name_ru', 'name_ro', 'name_en',
        'name_issuer_ru', 'name_issuer_ro', 'name_issuer_en',
        'topic_ru', 'topic_ro', 'topic_en',
        'description_ru', 'description_ro', 'description_en',
        'access', 'status', 'image_path',
        'created_at', 'updated_at', 'deleted_at', 'published_at'
    ];

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_category', 'course_id', 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'course_role', 'course_id', 'role_id');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'course_document', 'course_id', 'document_id');
    }

}

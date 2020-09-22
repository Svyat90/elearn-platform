<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Document extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'documents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'approved_at',
        'published_at'
    ];

    protected $fillable = [
        'name_ru', 'name_ro', 'name_en',
        'name_issuer_ru', 'name_issuer_ro', 'name_issuer_en',
        'topic_ru', 'topic_ro', 'topic_en',
        'type', 'status', 'number', 'access', 'description', 'image_path', 'file_path',
        'created_at', 'updated_at', 'deleted_at', 'approved_at', 'published_at'
    ];

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'document_category', 'document_id', 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * @return BelongsToMany
     */
    public function relatedDocuments()
    {
        return $this->belongsToMany(
            self::class,
            'document_related',
            'document_id',
            'related_document_id'
        );
    }

}

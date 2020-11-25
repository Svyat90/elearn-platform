<?php

namespace App;

use App\Services\Document\DocumentService;
use App\Services\Search\Searchable;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Document extends Model
{
    use SoftDeletes,
        Auditable,
        Searchable;

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
        'type_ru', 'type_ro', 'type_en',
        'description_ru', 'description_ro', 'description_en',
        'status', 'number', 'access', 'image_path', 'file_path',
        'created_at', 'updated_at', 'deleted_at', 'approved_at', 'published_at'
    ];

    public function toArrayWithContent()
    {
        $content = DocumentService::getDocumentContent($this->file_path);

        return [
            'id' => $this->id,
            'name_ru' => $this->name_ru ?? "",
            'name_ro' => $this->name_ro ?? "",
            'name_en' => $this->name_en ?? "",
            'name_issuer_ru' => $this->name_issuer_ru ?? "",
            'name_issuer_ro' => $this->name_issuer_ro ?? "",
            'name_issuer_en' => $this->name_issuer_en ?? "",
            'description_ru' => $this->description_ru ?? "",
            'description_ro' => $this->description_ro ?? "",
            'description_en' => $this->description_en ?? "",
            'content' => $content
        ];
    }

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
    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'document_sub_category', 'document_id', 'sub_category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'document_role', 'document_id', 'role_id');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'document_user', 'document_id', 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_document', 'document_id', 'course_id');
    }

    /**
     * @return BelongsToMany
     */
    public function relatedDocuments()
    {
        return $this->belongsToMany(self::class, 'document_related', 'document_id', 'related_document_id');
    }

}

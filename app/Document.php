<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}

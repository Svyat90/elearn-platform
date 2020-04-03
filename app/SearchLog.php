<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    public $table = 'search_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'term',
        'page',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}

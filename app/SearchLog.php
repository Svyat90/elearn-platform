<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    use Auditable;

    public $table = 'search_logs';

    const SEARCH_FROM_SELECT = [
        '1' => 'Web',
        '2' => 'App',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'search_term',
        'search_from',
    ];
}

<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AgentMetum extends Model
{
    use Auditable;

    public $table = 'agent_meta';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'registered_on',
    ];

    protected $fillable = [
        'city',
        'state',
        'user_id',
        'agent_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'agent_status',
        'registered_on',
        'agent_commission',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function getRegisteredOnAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setRegisteredOnAttribute($value)
    {
        $this->attributes['registered_on'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');

    }
}

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

    const AGENT_STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Active',
        '3' => 'Not Active',
    ];


    protected $fillable = [
        'city',
        'state',
        'agent_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'agent_status',
        'registered_on',
        'agent_commission',
    ];

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

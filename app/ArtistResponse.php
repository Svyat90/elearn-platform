<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ArtistResponse extends Model
{
    use Auditable;

    public $table = 'artist_responses';

    const ARTIST_ACTION_SELECT = [
        '1' => 'Accept',
        '0' => 'Reject',
    ];

    const VIDEO_STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Completed',
        '3' => 'Rejected',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'action_update',
        'completion_update',
    ];

    protected $fillable = [
        'order_id',
        'video_id',
        'artist_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'artist_note',
        'video_status',
        'artist_action',
        'action_update',
        'completion_update',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');

    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');

    }

    public function getActionUpdateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setActionUpdateAttribute($value)
    {
        $this->attributes['action_update'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function getCompletionUpdateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setCompletionUpdateAttribute($value)
    {
        $this->attributes['completion_update'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function artist()
    {
        return $this->belongsTo(ArtistMetum::class, 'artist_id');

    }
}

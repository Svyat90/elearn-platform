<?php

namespace App;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmailSubscription extends Model
{
    use Auditable;

    public $table = 'email_subscriptions';

    const STATUS_RADIO = [
        '1' => 'Subscribed',
        '2' => 'UnSubscribed',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'subscribed_on',
        'unsubscribed_on',
    ];

    protected $fillable = [
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_address',
        'subscribed_on',
        'unsubscribed_on',
    ];

    public function getSubscribedOnAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setSubscribedOnAttribute($value)
    {
        $this->attributes['subscribed_on'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function getUnsubscribedOnAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setUnsubscribedOnAttribute($value)
    {
        $this->attributes['unsubscribed_on'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }
}

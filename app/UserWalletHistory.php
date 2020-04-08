<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class UserWalletHistory extends Model
{
    use Auditable;

    public $table = 'user_wallet_histories';

    const TXN_TYPE_SELECT = [
        '1' => 'Credit',
        '2' => 'Debit',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Pending',
        '2' => 'Approved',
        '3' => 'Not Approved',
    ];

    protected $fillable = [
        'amount',
        'status',
        'user_id',
        'txn_type',
        'txn_info',
        'created_at',
        'updated_at',
        'deleted_at',
        'earn_from_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function earn_from()
    {
        return $this->belongsTo(User::class, 'earn_from_id');

    }
}

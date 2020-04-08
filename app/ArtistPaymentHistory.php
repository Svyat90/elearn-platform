<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class ArtistPaymentHistory extends Model
{
    use Auditable;

    public $table = 'artist_payment_histories';

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
        '1' => 'pending',
        '2' => 'approved',
        '3' => 'not approved',
    ];

    const TXN_FOR_SELECT = [
        '1' => 'Video Fee',
        '2' => 'Refferal Earning',
        '3' => 'Payout',
    ];

    protected $fillable = [
        'status',
        'txn_for',
        'user_id',
        'txn_type',
        'any_fees',
        'txn_info',
        'created_at',
        'updated_at',
        'deleted_at',
        'any_charges',
        'final_amount',
        'proccesed_by',
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

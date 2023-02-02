<?php

namespace Domain\Order\Models;

use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Model;
use Domain\Order\States\Payment\PaymentState;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * @property PaymentState $state
 */
class Payment extends Model
{
    use HasUlids;
    use HasStates;

    protected $table = 'payments';
    protected $fillable = [
        'payment_id',
        'gateway',
        'meta'
    ];

    protected $casts = [
        'meta' => 'collection',
        'state' => PaymentState::class
    ];

    public function uniqueIds(): array
    {
        return ['payment_id'];
    }
}
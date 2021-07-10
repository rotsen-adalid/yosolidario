<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'payment_transactions';

    protected $fillable = [
        'amount_transaction',
        'date',
        'hour',
        'data',
        'payment_order_id'
    ];

    // uno a uno inversa
    public function paymentOrder() {
        return $this->belongsTo(PaymentOrder::class);
    }
}

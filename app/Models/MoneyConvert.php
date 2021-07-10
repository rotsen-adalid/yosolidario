<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyConvert extends Model
{
    use HasFactory;
    
    protected $table = 'money_converts';

    protected $fillable = [
        'amount_of',
        'money_id_of',
        'amount_buy',
        'amount_sale',
        'money_id_a',
        'agency_id'
    ];

    // uno a muchos inversa
    public function moneyOf() {
        return $this->belongsTo(Money::class, 'money_id_of');
    }

    // uno a muchos inversa
    public function moneyA() {
        return $this->belongsTo(Money::class, 'money_id_a');
    }

    // uno a muchos inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencySetting extends Model
{
    use HasFactory;

    protected $table = 'agency_settings';

    protected $fillable = [
        'amount_min',
        'amount_max',
        'money_id',
        'buy_usd',
        'sale_usd',
        'agency_id',
    ];

    // uno a muchos inversa
    public function money() {
        return $this->belongsTo(Money::class);
    }

    // uno a uno inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

     // relacion polimorfica uno a muchos
     public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}
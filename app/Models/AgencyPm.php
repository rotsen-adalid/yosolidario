<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyPm extends Model
{
    use HasFactory;
    protected $table = 'agency_pms';

    protected $fillable = [
        'commission_amount',
        'commission_percentage',
        'money_id',
        'agency_id',
        'type',
        'status'
    ];

    // uno a muchos inversa
    public function money() {
        return $this->belongsTo(Money::class);
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


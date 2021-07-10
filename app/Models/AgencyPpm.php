<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyPpm extends Model
{
    use HasFactory;

    protected $table = 'agency_ppms';

    protected $fillable = [
        'agency_pp_id',
        'payment_method',
        'code',
        'money_id',
        'range_of',
        'range_up_to',
        'commission_amount',
        'commission_percentage',
        'agency_id',
        'status'    
    ];

    // uno a muchos inversa
    public function agencyPp() {
        return $this->belongsTo(AgencyPp::class);
    }

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

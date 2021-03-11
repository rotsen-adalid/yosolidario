<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyPp extends Model
{
    use HasFactory;

    protected $table = 'agency_pps';

    protected $fillable = [
        'name',
        'contact_references',
        'agency_id',
        'status'
    ];

    // uno a muchos inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    // uno a muchos 
    public function agencyPpm() {
        return $this->hasMany(AgencyPpm::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

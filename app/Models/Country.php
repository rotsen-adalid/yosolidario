<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    
    protected $fillable = [
        'name',
        'slug',
        'code',
        'phone_prefix',
        'states_denomination',
        'country_estates',
        'status',
        'money_id',
        'search'
    ];

    // uno a muchos inversa
    public function money() {
        return $this->belongsTo(Money::class);
    }

    // uno a muchos 
    public function countryStates() {
        return $this->hasMany(CountryState::class);
    }

    // uno a muchos 
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // uno a muchos 
    public function organizations() {
        return $this->hasMany(Organization::class);
    }

    // uno a muchos
    public function personalInformations() {
        return $this->hasMany(PersonalInformation::class);
    }

    // uno a muchos
    public function paymentOrders() {
        return $this->hasMany(PaymentOrder::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}


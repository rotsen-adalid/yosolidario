<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $table = 'agencies';

    protected $fillable = [
        'denomination',
        'identification',
        'identification_path',
        'addres',
        'representative',
        'country_id',
        'type',
        'status',
        'search'
    ];

    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }

    // uno a muchos 
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // uno a muchos 
    public function agencyPps() {
        return $this->hasMany(AgencyPp::class);
    }

    // uno a muchos 
    public function agencyPpms() {
        return $this->hasMany(AgencyPpm::class);
    }

    // uno a muchos 
    public function agencyPms() {
        return $this->hasMany(AgencyPm::class);
    }

     // uno a uno
     public function agencySetting() {
        return $this->hasOne(AgencySetting::class);
    }

    // uno a muchos 
    public function agencyUsers() {
        return $this->hasMany(AgencyUser::class);
    }

    // uno a muchos 
    public function organizations() {
        return $this->hasMany(Organization::class);
    }

    // muchos a muchos
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // uno a muchos 
    public function personalInformations() {
        return $this->hasMany(PersonalInformation::class);
    }
    
    // relacion polimorfica uno a uno
    public function telegram() {
        return $this->morphOne(Telegram::class, 'telegramable');
    }

    // uno a muchos 
    public function paymentOrders() {
        return $this->hasMany(PaymentOrder::class);
    }

    // muchos a muchos
    public function moneys()
    {
        return $this->belongsToMany(Money::class)->withTimestamps();
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

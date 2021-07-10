<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;

    protected $table = 'money';

    protected $fillable = [
        'currency_symbol',
        'currency_iso',
    ];

    // uno a muchos 
    public function country() {
        return $this->hasMany(Country::class);
    }

    // uno a muchos 
    public function agencyProcessorPaymentMethods() {
        return $this->hasMany(AgencyProcessorPaymentMethod::class);
    }

    // uno a muchos 
    public function agencyPaymentMethods() {
        return $this->hasMany(AgencyPaymentMethod::class);
    }

    // uno a uno
    public function paymentOrder() {
        return $this->hasOne(PaymentOrder::class);
    }

    // muchos a muchos
    public function agencies()
    {
        return $this->belongsToMany(Agency::class)->withTimestamps();
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

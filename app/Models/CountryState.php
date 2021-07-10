<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryState extends Model
{
    use HasFactory;

    protected $table = 'country_states';
    
    protected $fillable = [
        'name',
        'slug',
        'code',
        'country_id',
        'status',
        'search'
    ];

    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }

    // uno a muchos
    public function paymentOrders() {
        return $this->hasMany(PaymentOrder::class);
    }

    // uno a muchos 
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // uno a muchos
    public function personalInformations() {
        return $this->hasMany(PersonalInformation::class);
    }
}

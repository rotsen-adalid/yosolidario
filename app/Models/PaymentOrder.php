<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrder extends Model
{
    use HasFactory;

    protected $table = 'payment_orders';

    protected $fillable = [
        'code_collection',
        'id_transaction',

        'name',
        'lastname',
        'locality',
        'address',
        'country_id',
        'country_estate_id',

        'email',
        'phone_prefix',
        'phone',
        'show_name',
        'commentary',
        'commentary_hidden',

        'amount_total',
        'amount_user',
        'amount_yosolidario',
        'amount_percentage_yosolidario',
        
        'payment_method',
        'money_id',
        'agency_id',
        'user_id',
        'type_user',
        'type',
        'status_transaction',
        'status',
        'search'
    ];

    // uno a uno inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    // uno a uno inversa
    public function user() {
        return $this->belongsTo(User::class);
    }

    // uno a uno inversa
    public function money() {
        return $this->belongsTo(Money::class);
    }

    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }
    
    // uno a muchos inversa
    public function countryState() {
        return $this->belongsTo(CountryState::class);
    }

    // uno a uno 
    public function paymentOrderCampaign()
    {
        return $this->hasOne(PaymentOrderCampaign::class);
    }

    // uno a uno 
    public function paymentOrderOrganization()
    {
        return $this->hasOne(PaymentOrderOrganization::class);
    }

    // uno a uno 
    public function collection()
    {
        return $this->hasOne(Collection::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

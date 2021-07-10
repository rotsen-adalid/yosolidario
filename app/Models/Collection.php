<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'collections';
    
    protected $fillable = [
        'amount',
        'commission_amount_pp',
        'commission_percentage_pp',
        'commission_total_pp',

        'commission_amount_yosolidario',
        'commission_percentage_yosolidario',
        'commission_total_yosolidario',

        'iva',
        'iva_total',

        'commission_total',

        'amount_organizer',
        'amount_percentage_organizer',

        'utility_yosolidario',
        'utility_percentage_yosolidario',
        'utility_total_yosolidario',

        'money_id',
        'payment_order_id',
        'agency_ppm_id',
        'agency_pm_id',
        'agency_id',

        // convert 
        'amount_deposited_organizer_convert',
        'amount_deposited_yosolidario_convert',
        'amount_deposited_total_convert',
        
        'amount_commission_pp_convert',
        'amount_commission_yosolidario_convert',
        'iva_total_convert',

        'amount_organizer_convert',
        'utility_yosolidario_convert',
        'utility_total_yosolidario_convert',
        'amount_convert_buy',
        'money_convert_id',

        'status',
        'date_payment'
    ];

    // uno a muchos inversa
    public function money() {
        return $this->belongsTo(Money::class, 'money_id');
    }

     // uno a muchos inversa
     public function moneyConvert() {
        return $this->belongsTo(Money::class, 'money_convert_id');
    }

    // uno a uno inversa
    public function paymentOrder() {
        return $this->belongsTo(PaymentOrder::class);
    }

    // uno a muchos inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    // uno a muchos inversa
    public function agencyPpm() {
        return $this->belongsTo(AgencyPpm::class);
    }

    // uno a muchos inversa
    public function agencyPm() {
        return $this->belongsTo(AgencyPm::class);
    }

    // ++++++++++ BOLIVIA +++++++++++ //
    // uno a uno 
    public function endpointBoPagosnet()
    {
        return $this->hasOne(EndpointBoPagosnet::class);
    }
    // uno a uno 
    public function endpointBoPagofacil()
    {
        return $this->hasOne(EndpointBoPagofacil::class);
    }
}

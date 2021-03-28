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
        'email',
        'phone',
        'show_name',
        'commentary',
        
        'amount_total',
        'amount_collaborator',
        'amount_yosolidario',
        'amount_percentage_yosolidario',

        'payment_method',
        'money_id',
        'campaign_id',
        'agency_id',
        'agency_pp_id',
        'user_id',
        'type_user',
        'campaign_reward_id',
        'type_collaboration',
        'status',
        'search'
    ];

    // uno a uno inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    // uno a uno inversa
    public function agencyPp() {
        return $this->belongsTo(AgencyPp::class);
    }

    // uno a uno inversa
    public function user() {
        return $this->belongsTo(User::class);
    }

     // uno a uno inversa
     public function campaign() {
        return $this->belongsTo(Campaign::class);
    }

    // uno a uno inversa
    public function campaignReward() {
        return $this->belongsTo(CampaignReward::class);
    }

    // uno a muchos 
    public function pagosnetRegistroplans() {
        return $this->hasMany(PagosnetRegistroplan::class);
    }

    // uno a uno inversa
    public function money() {
        return $this->belongsTo(Money::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

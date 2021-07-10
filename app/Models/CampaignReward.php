<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignReward extends Model
{
    use HasFactory;

    protected $table = 'campaign_rewards';

    protected $fillable = [
        'image_url',
        'amount',
        'description',
        //'description_es',
        //'description_en',
        //'description_pt_BR',
        'delivery_date',
        'limiter',
        'quantity',
        'collaborators',
        'campaign_id',
        'status'
    ];

    // uno a muchos inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }

    // uno a muchos 
    public function paymentOrderCampaigns() {
        return $this->hasMany(PaymentOrderCampaign::class);
    }
    
    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

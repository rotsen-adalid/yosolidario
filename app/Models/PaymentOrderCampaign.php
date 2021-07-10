<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrderCampaign extends Model
{
    use HasFactory;

    protected $table = 'payment_order_campaigns';

    protected $fillable = [
        'campaign_id',
        'campaign_reward_id',
        'type_collaboration',
        'payment_order_id'
    ];

    // uno a muchos inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }

    // uno a uno inversa
    public function campaignReward() {
        return $this->belongsTo(CampaignReward::class);
    }

    // uno a uno inversa
    public function paymentOrder() {
        return $this->belongsTo(PaymentOrder::class);
    }
}

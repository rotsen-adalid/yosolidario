<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationReward extends Model
{
    use HasFactory;

    protected $table = 'organization_rewards';

    protected $fillable = [
        'image_url',
        'amount',
        'description',
        'delivery_date',
        'limiter',
        'quantity',
        'collaborators',
        'organization_id',
        'status'
    ];

    // uno a muchos inversa
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    // uno a muchos 
    public function paymentOrderCampaigns() {
        return $this->hasMany(PaymentOrderCampaign::class);
    }
}

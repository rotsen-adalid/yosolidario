<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOrderOrganization extends Model
{
    use HasFactory;

    protected $table = 'payment_order_organizations';

    protected $fillable = [
        'organization_id',
        'organization_reward_id',
        'type_collaboration',
        'payment_order_id'
    ];

    // uno a muchos inversa
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    // uno a uno inversa
    public function organizationReward() {
        return $this->belongsTo(OrganizationReward::class);
    }

    // uno a uno inversa
    public function paymentOrder() {
        return $this->belongsTo(PaymentOrder::class);
    }
}

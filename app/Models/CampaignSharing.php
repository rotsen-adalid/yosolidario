<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignSharing extends Model
{
    use HasFactory;

    protected $table = 'campaign_sharings';

    protected $fillable = [
        'campaign_id',
        'campaign_sharing_id',
        'status'
    ];

    // uno a muchos inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    // uno a muchos inversa
    public function campaignSharingConvert() {
        return $this->belongsTo(Campaign::class, 'campaign_sharing_id');
    }
}

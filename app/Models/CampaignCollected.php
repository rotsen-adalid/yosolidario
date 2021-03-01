<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignCollected extends Model
{
    use HasFactory;
    protected $table = 'campaign_collecteds';

    protected $fillable = [
        'collaborators',
        'amount_target',
        'amount_collected',
        'amount_percentage_collected',
        'last_deposit',
        'campaign_id',
        'status',
    ];

    // uno a uno inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

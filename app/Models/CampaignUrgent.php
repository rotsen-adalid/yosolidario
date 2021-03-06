<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignUrgent extends Model
{
    use HasFactory;

    protected $table = 'campaign_urgents';

    protected $fillable = [
        'campaign_id',
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

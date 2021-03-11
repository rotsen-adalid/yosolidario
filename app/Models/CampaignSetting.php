<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignSetting extends Model
{
    use HasFactory;

    protected $table = 'campaign_settings';
    
    protected $fillable = [
        'seo_keywords',
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

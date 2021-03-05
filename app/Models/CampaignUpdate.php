<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignUpdate extends Model
{
    use HasFactory;

    protected $table = 'campaign_updates';

    protected $fillable = [
        'title',
        'body',
        'update_photo_path',
        'campaign_id',
        'user_id',
    ];

    // uno a muchos inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}


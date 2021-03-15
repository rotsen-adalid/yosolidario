<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignSave extends Model
{
    use HasFactory;

    protected $table = 'campaign_saves';

    protected $fillable = [
        'campaign_id',
        'user_id',
    ];

    // uno a muchos
    public function user() {
        return $this->belongsTo(User::class);
    }

    // uno a muchos inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

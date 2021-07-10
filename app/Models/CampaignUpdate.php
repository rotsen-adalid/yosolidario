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
        'campaign_id',
        'user_id',
    ];

    // uno a muchos inversa
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // uno a muchos inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
    // relacion polimorfica uno a uno
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
    // relacion polimorfica uno a uno
    public function video() {
        return $this->morphOne(Video::class, 'videoable');
    }
    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}


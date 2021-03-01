<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignOpeningRequest extends Model
{
    use HasFactory;

    protected $table = 'campaign_opening_requests';

    protected $fillable = [
        'order_number',
        'campaign_id',
        'date_send',
        'date_revised',
        'data_campaign',
        'data_personal_information',
        'suggestions',
        'observations',
        'user_reviewer_id',
        
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

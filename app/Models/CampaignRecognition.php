<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignRecognition extends Model
{
    use HasFactory;

    protected $table = 'campaign_recognitions';

    protected $fillable = [
        'image_url',
        'amount',
        'description',
        'description_es',
        'description_en',
        'description_pt_BR',
        'delivery_date',
        'limiter',
        'quantity',
        'collaborators',
        'campaign_id'

    ];

    // uno a muchos inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
}

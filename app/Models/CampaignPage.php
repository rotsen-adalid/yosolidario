<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignPage extends Model
{
    use HasFactory;

    protected $table = 'campaign_pages';
    
    protected $fillable = [
        'logo_page_path',
        'page_url',
        'page_return',
        'color_text',
        'color_button_current',
        'color_button_text',
        'campaign_id',
    ];
    // uno a uno inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
}

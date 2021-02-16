<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignQuestion extends Model
{
    use HasFactory;

    protected $table = 'campaign_questions';

    protected $fillable = [
        'about',
        'about_es',
        'about_en',
        'about_pt_BR',
        'about_url',

        'use_of_money',
        'use_of_money_es',
        'use_of_money_en',
        'use_of_money_pt_BR',
        'use_of_money_url',

        'about_organizer',
        'about_organizer_es',
        'about_organizer_en',
        'about_organizer_pt_BR',
        'about_organizer_url',

        'delivery_of_awards',
        'delivery_of_awards_es',
        'delivery_of_awards_en',
        'delivery_of_awards_pt_BR',
        'delivery_of_awards_url',

        'contact_organizer',
        'contact_organizer_es',
        'contact_organizer_en',
        'contact_organizer_pt_BR',
        'contact_organizer_url',

        'question_title_add',
        'question_title_add_es',
        'question_title_add_en',
        'question_title_add_pt_BR',
        'question_body_add',
        'question_body_add_es',
        'question_body_add_en',
        'question_body_add_pt_BR',
        'question_url_add',
        
        'campaign_id'
    ];

    // uno a uno inversa
    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
}

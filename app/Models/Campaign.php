<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\CategoryCampaign;
use App\Models\CampaignQuestion;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    protected $fillable = [
        'title',
        'title_es',
        'title_en',
        'title_pt_BR',
        'slug',
        'extract',
        'extract_es',
        'extract_en',
        'extract_pt_BR',
        'type_campaign',
        'period',
        'amount_target',
        'amount_collected',
        'amount_percentage_collected',

        'views',
        'collaborators',
        'shared',
        'followers',

        'locality',
        'telephone_country_id',
        'telephone',

        'user_id',
        'category_campaign_id',
        'country_id',
        'organization_id',

        'search',
        
        'status',
        'status_register',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    // uno a muchos inversa
    public function user() {
        return $this->belongsTo(User::class);
    }
    // uno a muchos inversa
    public function categoryCampaign() {
        return $this->belongsTo(CategoryCampaign::class);
    }
    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }
    // uno a uno 
    public function campaignQuestion() {
        // return $this->hasMany(CampaignQuestion::class);
        return $this->hasMany(CampaignQuestion::class);
    }
    // relacion polimorfica uno a uno
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
    // relacion polimorfica uno a uno
    public function video() {
        return $this->morphOne(Video::class, 'videoable');
    }
    // uno a muchos 
    public function campaignRecognitios() {
        return $this->hasMany(CampaignRecognition::class);
    }
    // uno a muchos inversa
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

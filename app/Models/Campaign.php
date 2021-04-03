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
        //'title_es',
        //'title_en',
        //'title_pt_BR',
        'slug',
        'extract',
        //'extract_es',
        //'extract_en',
        //'extract_pt_BR',
        'type_campaign',
        'period',

        'views',
        'collaborators',
        'shareds',
        'followers',

        'locality',
        'phone_prefix',
        'phone',

        'user_id',
        'category_campaign_id',
        'country_id',
        'country_state_id',
        'organization_id',
        'agency_id',

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

    // uno a muchos
    public function campaignSaves() {
        return $this->hasMany(CampaignSave::class);
    }

    // uno a muchos inversa
    public function categoryCampaign() {
        return $this->belongsTo(CategoryCampaign::class);
    }
    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }
    // uno a muchos inversa
    public function countryState() {
        return $this->belongsTo(CountryState::class);
    }
    // uno a muchos inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }
    // uno a uno
    public function campaignCollected() {
        return $this->hasOne(CampaignCollected::class);
    }
    // uno a uno
    public function campaignUrgent() {
        return $this->hasOne(CampaignUrgent::class);
    }
    // uno a uno
    public function campaignQuestion() {
        return $this->hasOne(CampaignQuestion::class);
    }
    // uno a muchos 
    public function campaignReward() {
        return $this->hasMany(CampaignReward::class);
    }
    // uno a uno
    public function campaignOpeningRequest() {
        return $this->hasOne(CampaignOpeningRequest::class);
    }
    // uno a uno
    public function campaignSetting() {
        return $this->hasOne(CampaignSetting::class);
    }
    // uno a muchos 
    public function campaignUpdates() {
        return $this->hasMany(CampaignUpdate::class);
    }
    // uno a muchos 
    public function campaignTeam() {
        return $this->hasMany(CampaignTeam::class);
    }

    // uno a muchos 
    public function paymentOrders() {
        return $this->hasMany(PaymentOrder::class);
    }

    // relacion polimorfica uno a uno
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
    // relacion polimorfica uno a uno
    public function video() {
        return $this->morphOne(Video::class, 'videoable');
    }
    // uno a muchos inversa
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // relacion polimorfica uno a uno
    public function telegram() {
        return $this->morphOne(Image::class, 'telegramable');
    }
    
    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

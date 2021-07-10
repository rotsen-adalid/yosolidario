<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Country;
use App\Models\Agreement;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'slug',
        'logo_path',
        'identification',
        'identification_path',
        'type',
        'country_id',
        'country_state_id',
        'agency_id',
        'address',
        'longitude',
        'latigude',
        'locality',

        'phone',
        'phone_movil',
        'email',
        'website',
        'references_contact',

        'about',
        'observations',

        'status',

        'search'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // uno a muchos inversa
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }
    // uno a uno 
    public function organizationAgreement()
    {
        return $this->hasOne(OrganizationAgreement::class);
    }
    // uno a muchos 
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // relacion polimorfica uno a muchos
    public function bankInfo() {
        return $this->morphOne(BankInfo::class, 'bankinfoable');
    }

    // muchos a muchos
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // uno a uno 
    public function organizationProfile()
    {
        return $this->hasOne(OrganizationProfile::class);
    }

    // uno a muchos 
    public function organizationActivities() {
        return $this->hasMany(OrganizationActivity::class);
    }
    
    // uno a uno 
    public function organizationCollected()
    {
        return $this->hasOne(OrganizationCollected::class);
    }
    
    // uno a uno
    public function organizationSession() {
        return $this->hasOne(OrganizationSession::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
    
}

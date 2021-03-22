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
        'agency_id',
        'address',
        'longitude',
        'latigude',
        'locality',

        'telephone',
        'telephone_movil',
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

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

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
        'logo',
        'identification',
        'identification_image',
        'type',

        'country_id',
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
        'note',

        'status_organization',
        'status_agreement',

        'search'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // uno a muchos inversa
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    // uno a uno 
    public function agreement()
    {
        return $this->hasOne(Agreement::class);
    }
    // uno a muchos 
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

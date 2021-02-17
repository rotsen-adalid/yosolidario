<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Campaign;
use App\Models\Country;
//use App\Traits\UserTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable // implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    //use UserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'slug',
        'email', 
        'password', 
        'profile_photo_path',
        'country_id',
        'status',
        'search'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    /*
    public function getRouteKeyName()
    {
        return 'slug';
    }*/
    
    // uno a uno
    public function personalInformation() {
        return $this->hasMany(PersonalInformation::class);
    }

    // uno a uno
    public function profile() {
        return $this->hasMany(Profile::class);
    }

    // uno a muchos
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // uno a muchos inversa
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // relacion polimorfica uno a uno
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
    
     // uno a muchos inversa
     public function agency()
     {
         return $this->belongsTo(Agency::class);
     }
}

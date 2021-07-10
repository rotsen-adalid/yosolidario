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
        'lastname', 
        'slug',
        'email', 
        'password', 
        'profile_photo_path',
        
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
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    // uno a uno
    public function personalInformation() {
        return $this->hasOne(PersonalInformation::class);
    }

    // uno a uno
    public function profile() {
        return $this->hasOne(Profile::class);
    }

    // uno a muchos
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // uno a muchos
    public function campaignSaves() {
        return $this->hasMany(CampaignSave::class);
    }

    // relacion polimorfica uno a uno
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }

    // relacion muchos a muchos
    public function agencies()
    {
        return $this->belongsToMany(Agency::class);
    }
    
    // uno a muchos 
    public function paymentOrders() {
        return $this->hasMany(PaymentOrder::class);
    }
    
    // uno a muchos 
    public function geolocationUsers() {
        return $this->hasMany(GeolocationUser::class);
    }

    // relacion muchos a muchos
    public function sites()
    {
        return $this->belongsToMany(Site::class)->withTimestamps();
    }
    
    // relacion muchos a muchos
    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    // uno a uno
    public function organizationSession() {
        return $this->hasOne(OrganizationSession::class);
    }

    // function autorize site
    public function authorizeSites($sites)
    {
        abort_unless($this->hasAnySite($sites), 401);
        return true;
    }

    public function hasAnySite($sites)
    {
        if (is_array($sites)) {
            foreach ($sites as $role) {
                if ($this->hasSite($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasSite($sites)) {
                 return true; 
            }   
        }
        return false;
    }
    
    public function hasSite($role)
    {
        if ($this->sites()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}

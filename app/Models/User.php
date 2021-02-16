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

use App\Models\Telephone;
use App\Models\Campaign;
use App\Models\Country;

class User extends Authenticatable // implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
    public function personaInformation() {
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

    // muchos a muchos
    public function accesess()
    {
        return $this->belongsToMany(Access::class)->withTimestamps();
    }

    // relacion polimorfica uno a uno
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function authorizeAccesses($roles)
    {
        abort_unless($this->hasAnyAccess($roles), 401);
        return true;
    }
    public function hasAnyAccess($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasAccess($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasAccess($roles)) {
                return true; 
            }   
        }
        return false;
    }
    public function hasAccess($role)
    {
        if ($this->accesses()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
    
}

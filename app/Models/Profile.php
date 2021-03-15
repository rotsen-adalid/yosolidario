<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'country_id',
        'locality',

        'biography', 
        'telephone', 
        'facebook', 
        'twitter', 
        'instagram',
        'whatsapp',
        'telegram',
        'website',

        'status',
    
        'user_id',
    ];

    // uno a uno inversa
    public function user() {
        return $this->belongsTo(user::class);
    }

    // uno a muchos inversa
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

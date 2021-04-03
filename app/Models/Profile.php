<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [

        'biography', 
        'phone_prefix', 
        'phone',
        'facebook', 
        'twitter', 
        'instagram',
        'whatsapp_prefix',
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

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

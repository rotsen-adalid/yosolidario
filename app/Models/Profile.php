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
        'telephone_country_id', 
        'telephone', 
        'facebook', 
        'twitter', 
        'instagram',
        'whatsapp_country_id',
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
}

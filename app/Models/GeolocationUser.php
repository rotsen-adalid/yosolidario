<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeolocationUser extends Model
{
    use HasFactory;

    protected $table = 'geolocation_users';
    
    protected $fillable = [
        'ipapi',
        'type_person',
        'user_id'
    ];

    // uno a muchos inversa
    public function user() {
        return $this->belongsTo(User::class);
    }
}

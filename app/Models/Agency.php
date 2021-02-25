<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $table = 'agencies';

    protected $fillable = [
        'denomination',
        'slug',
        'identification',
        'identification_image',
        'addresses',
        'email_contact',
        'representative',
        'user_id',
        'country_id',
        'type',
        'status',
        'search'
    ];

    // uno a muchos 
    public function users() {
        return $this->hasMany(User::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

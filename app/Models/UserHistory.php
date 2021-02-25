<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $table = 'user_histories';

    protected $guarded = [];

    //relacion polimorfica
    public function userhistoriesable() {
        return $this->morphTo();
    }
    
    // uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // uno a muchos inversa
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}

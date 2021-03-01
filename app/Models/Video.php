<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    //relacion polimorfica
    public function videoable() {
        return $this->morphTo();
    }

     // relacion polimorfica uno a muchos
     public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

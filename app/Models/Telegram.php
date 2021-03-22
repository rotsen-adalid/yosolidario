<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telegram extends Model
{
    use HasFactory;

    protected $table = 'telegrams';

    protected $guarded = [];

    // uno a muchos inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    //relacion polimorfica
    public function telegramable() {
        return $this->morphTo();
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;

    protected $table = 'bank_infos';
    protected $guarded = [];
    
    // uno a muchos inversa
    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    //relacion polimorfica
    public function bankinfoable() {
        return $this->morphTo();
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    // uno a uno inversa
    public function user() {
        return $this->belongsTo(user::class);
    }
}

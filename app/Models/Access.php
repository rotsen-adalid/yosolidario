<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description'
    ];

    // muchos a muchos
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

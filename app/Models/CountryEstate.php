<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryEstate extends Model
{
    use HasFactory;

    protected $table = 'country_estates';
    
    protected $fillable = [
        'name',
        'slug',
        'code',
        'country_id',
        'search'
    ];

    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }
}

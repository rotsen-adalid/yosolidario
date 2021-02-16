<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    
    protected $fillable = [
        'name',
        'slug',
        'code_coi',
        'telephone_prefix',
        'currency_symbol',
        'currency_iso',
        'status_published_campaign',
        'search'
    ];
    
    // uno a muchos 
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

    // uno a muchos
    public function user() {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraud extends Model
{
    use HasFactory;

    protected $table = 'frauds';

    protected $fillable = [
        'name',
        'country_id',
        'number_phone',
        'email',
        'url_campaign',
        'know_organizer',
        'know_organizer_describe',
        'whistleblower',
        'whistleblower_describe',
        'whistleblower_other',
    ];

    // uno a muchos inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

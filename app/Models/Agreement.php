<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Organization;

class Agreement extends Model
{
    use HasFactory;

    protected $table = 'agreements';

    protected $fillable = [
        'organization_id',
        'organization_representative',
        'yosolidario_representative',
        'date_signed',
        'note',
        'status_agreement'
    ];
    //uno a uno inversa
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

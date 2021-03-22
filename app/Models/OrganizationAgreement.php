<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationAgreement extends Model
{
    use HasFactory;

    
    protected $table = 'organization_agreements';

    protected $fillable = [
        'representative',
        'other_representatives',
        'representative_agency',
        'other_representatives_agency',
        'type',
        'agreement_date',
        'observations',
        'organization_id',
        'status',
    ];
   
    // uno a muchos inversa
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

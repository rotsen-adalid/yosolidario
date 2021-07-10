<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationCollected extends Model
{
    use HasFactory;

    protected $table = 'organization_collecteds';

    protected $fillable = [
        'collaborators',
        'amount_collected',
        'last_deposit',
        'organization_id',
        'status',
    ];

    // uno a uno inversa
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}

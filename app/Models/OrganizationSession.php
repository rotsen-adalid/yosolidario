<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationSession extends Model
{
    use HasFactory;

    protected $table = 'organization_sessions';

    protected $fillable = [
        'user_id',
        'organization_id'
    ];

    // uno a uno inversa
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    // uno a uno inversa
    public function user() {
        return $this->belongsTo(User::class);
    }
}

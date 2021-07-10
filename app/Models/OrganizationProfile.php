<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    use HasFactory;

    protected $table = 'organization_profiles';

    protected $fillable = [
        'logo_path',

        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'tiktok',
        'whatsapp_prefix',
        'whatsapp',
        'telegram',
        'website',
        'organization_id'
    ];

    // uno a uno inversa
    public function organization() {
        return $this->belongsTo(Organization::class);
    }
}

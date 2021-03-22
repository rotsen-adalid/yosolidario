<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $table = 'personal_information';

    protected $fillable = [
        'name',
        'last_name',
        'identification_type',
        'identification',
        'identification_exp',
        'identification_obverse_path',
        'identification_back_path',
        'telephone',
        'telephone_movil',
        'email',
        'address',
        'longitude',
        'latigude',
        'locality',
        'face_path',
        'address_document_path',
        'marital_status',
        'gender',
        'reference_contact',
        'user_id',
        'country_id',
        'agency_id',
        'status',
        'search'
    ];

    // uno a uno inversa
    public function user() {
        return $this->belongsTo(user::class);
    }
    // uno a uno inversa
    public function bank() {
        return $this->belongsTo(Bank::class);
    }
    // uno a uno inversa
    public function country() {
        return $this->belongsTo(Country::class);
    }
    // uno a uno inversa
    public function agency() {
        return $this->belongsTo(Agency::class);
    }
    // relacion polimorfica uno a uno
     public function bankInfo() {
        return $this->morphOne(BankInfo::class, 'bankinfoable');
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

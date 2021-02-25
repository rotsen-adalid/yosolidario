<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Campaign;

class CategoryCampaign extends Model
{
    use HasFactory;

    protected $table = 'category_campaigns';

    protected $fillable = [
        'name',
        'slug',
        'name_icon',
        'type',
        'status',
        'search'
    ];

    // uno a muchos
    public function campaigns() {
        return $this->hasMany(Campaign::class);
    }

   // relacion polimorfica uno a muchos
   public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
 
}

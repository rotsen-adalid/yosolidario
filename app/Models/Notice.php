<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Notice extends Model
{
    use HasFactory;
    use Notifiable;

    //protected $primaryKey = 'id';
    //protected $keyType = 'string';
    //protected $incrementing = false;

    protected $table = 'notices';

    protected $fillable = [
        'telegramid',
        'notice',
        'description',
        'linkOne',
        'linkTwo',
        'action'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosnetRegistromdd extends Model
{
    use HasFactory;

    protected $table = 'pagosnet_registromdds';

    protected $fillable = [
        'comercioId',
        'id_mdd',
        'transaccionMdd',
        'vertical',
        'pagosnet_registroplan_id',
    ];

    // uno a uno inversa
    public function pagosnetRegistroplan() {
        return $this->belongsTo(PagosnetRegistroplan::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

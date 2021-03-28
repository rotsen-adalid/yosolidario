<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosnetRegistroth extends Model
{
    use HasFactory;

    protected $table = 'pagosnet_registroths';

    protected $fillable = [
        'transaccionTH',
        'nombre',
        'email',
        'telefono',
        'pais',
        'departamento',
        'ciudad',
        'direccion',
        'idTransaccion',
        'codigoError',
        'descripcionError',
        'pagosnet_registroplan_id',
    ];

    // uno a uno inversa
    public function pagosnetRegistroplan() {
        return $this->belongsTo(PagosnetRegistroplan::class);
    }
}

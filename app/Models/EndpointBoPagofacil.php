<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndpointBoPagofacil extends Model
{
    use HasFactory;

    protected $table = 'endpoint_bo_pagosnets';

    protected $fillable = [
        'PedidoID',
        'Fecha',
        'Hora',
        'Estado',
        'MetodoPago',
        'collection_id'
    ];

    // uno a uno inversa
    public function collection() {
        return $this->belongsTo(Collection::class);
    }
}

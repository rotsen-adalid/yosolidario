<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndpointBoPagosnet extends Model
{
    use HasFactory;

    protected $table = 'endpoint_bo_pagosnets';

    protected $fillable = [
        'usuario',
        'clave',
        'codigoEmpresa',
        'codigoRecaudacion',
        'codigoProducto',
        'numeroPago',
        'fecha',
        'secuencial',
        'hora',
        'origenTransaccion',
        'pais',

        'departamento',
        'ciudad',
        'entidad',
        'agencia',
        'operador',
        'monto', 
        'loteDosifciacion',
        'nroRentaRecibo',
        'montoCreditoFiscal',
        'codigoAutorizacion',

        'codigoControl',
        'nitFacturar',
        'nombreFacturar',
        'transaccion',
        
        'collection_id'
    ];

    // uno a uno inversa
    public function collection() {
        return $this->belongsTo(Collection::class);
    }
}

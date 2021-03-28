<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosnetRegistroplan extends Model
{
    use HasFactory;

    protected $table = 'pagosnet_registroplans';

    protected $fillable = [
        'transaccion',
        'documentoIdentidadComprador',
        'codigoComprador',
        'fecha',
        'hora',
        'correoElectronico',
        'moneda',
        'codigoRecaudacion',
        'descripcionRecaudacion',
        'fechaVencimiento',
        'horaVencimiento',
        'categoriaProducto',
        'precedenciaCobro',
        'numeroPago',
        'montoPago',
        'descripcion',
        'montoCreditoFiscal',
        'nombreFactura',
        'nitFactura',
        'idTransaccion',
        'codigoError',
        'descripcionError',
        'payment_order_id',
    ];

    // uno a uno inversa
    public function paymentOrder() {
        return $this->belongsTo(PaymentOrder::class);
    }

    // uno a uno
    public function pagosnetRegistroth() {
        return $this->hasOne(PagosnetRegistroth::class);
    }

    // uno a uno
    public function pagosnetRegistromdd() {
        return $this->hasOne(PagosnetRegistromdd::class);
    }

    // relacion polimorfica uno a muchos
    public function userHistories() {
        return $this->morphMany(UserHistory::class, 'userhistoriesable');
    }
}

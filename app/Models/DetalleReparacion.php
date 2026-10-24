<?php

namespace App\Models;

class DetalleReparacion extends Modelo
{
    protected $table = 'detalle_reparacion';
    protected $primaryKey = 'id_detalle_reparacion';

    public function precio() { return $this->belongsTo(PrecioServicio::class, 'id_precio'); }
}
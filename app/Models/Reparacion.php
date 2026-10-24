<?php

namespace App\Models;

class Reparacion extends Modelo
{
    protected $table = 'reparacion';
    protected $primaryKey = 'id_orden';

    const ESTADOS = ['Pendiente' => 'warning', 'En proceso' => 'info', 'Reparado' => 'primary', 'Entregado' => 'success'];

    public function detalles() { return $this->hasMany(DetalleReparacion::class, 'id_orden'); }
    public function repuestos() { return $this->hasMany(RepuestoUsado::class, 'id_orden'); }

    public function getTotalAttribute(): float
    {
        return $this->detalles->sum('precio_aplicado')
             + $this->repuestos->sum(fn ($r) => $r->cantidad * $r->precio_cobrado);
    }
}
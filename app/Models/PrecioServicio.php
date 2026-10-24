<?php

namespace App\Models;

class PrecioServicio extends Modelo
{
    protected $table = 'precio_servicio';
    protected $primaryKey = 'id_precio';

    const TIPOS = ['Cambio de pantalla', 'Cambio de puerto', 'Cambio de batería', 'Reparación de software', 'Cambio de cámara'];
}
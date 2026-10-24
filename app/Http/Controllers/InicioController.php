<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Reparacion;

class InicioController extends Controller
{
    public function __invoke()
    {
        return view('inicio', [
            'productos' => Producto::where('estado', 'Activo')->count(),
            'estados'   => Reparacion::selectRaw('estado, count(*) as total')->groupBy('estado')->pluck('total', 'estado'),
        ]);
    }
}
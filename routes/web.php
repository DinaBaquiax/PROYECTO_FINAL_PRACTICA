<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\PrecioServicioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/inicio');

Route::middleware('auth')->group(function () {
    Route::get('inicio', InicioController::class)->name('inicio');
    Route::resource('productos', ProductoController::class);
    Route::resource('reparaciones', ReparacionController::class)->parameters(['reparaciones' => 'reparacion']);
    Route::post('reparaciones/{reparacion}/servicio', [ReparacionController::class, 'servicio'])->name('reparaciones.servicio');
    Route::post('reparaciones/{reparacion}/repuesto', [ReparacionController::class, 'repuesto'])->name('reparaciones.repuesto');
    Route::resource('precios', PrecioServicioController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes');
    Route::get('reportes/producto', [ReporteController::class, 'producto'])->name('reportes.producto');
    Route::get('reportes/inventario', [ReporteController::class, 'inventario'])->name('reportes.inventario');
});

require __DIR__ . '/auth.php';
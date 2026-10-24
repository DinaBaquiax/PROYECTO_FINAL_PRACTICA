@extends('layouts.panel')
@section('titulo', 'Inicio')
@section('contenido')
<h4>Sistema Gestión de Inventario</h4>
<div class="row g-3 mt-1">
    @foreach ([['Productos activos', $productos], ['Reparaciones pendientes', $estados['Pendiente'] ?? 0],
               ['Reparaciones en proceso', $estados['En proceso'] ?? 0], ['Reparaciones entregadas', $estados['Entregado'] ?? 0]] as [$titulo, $n])
        <div class="col-6 col-lg-3"><div class="card text-center p-3">
            <div class="fs-1 fw-bold">{{ $n }}</div><small>{{ $titulo }}</small>
        </div></div>
    @endforeach
</div>
@endsection
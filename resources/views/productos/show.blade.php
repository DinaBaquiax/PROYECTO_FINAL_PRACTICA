@extends('layouts.panel')
@section('titulo', 'Detalle')
@section('contenido')
<h4>Detalles del Producto</h4>
<dl class="row">
    @foreach (['codigo' => 'Código', 'nombre' => 'Nombre', 'categoria' => 'Categoría', 'precio_compra' => 'Precio de compra',
               'precio_venta' => 'Precio de venta', 'stock' => 'Stock', 'fecha_registro' => 'Fecha de registro', 'estado' => 'Estado'] as $campo => $etiqueta)
        <dt class="col-sm-3">{{ $etiqueta }}</dt><dd class="col-sm-9">{{ $producto->$campo }}</dd>
    @endforeach
</dl>
<a href="{{ route('productos.index') }}" class="btn btn-light">Volver</a>
@endsection
@extends('layouts.panel')
@section('titulo', 'Producto')
@section('contenido')
<h4>{{ $producto->exists ? 'Editar' : 'Crear nuevo' }} producto</h4>
<form method="POST" class="row g-3" action="{{ $producto->exists ? route('productos.update', $producto) : route('productos.store') }}">
    @csrf
    @if ($producto->exists) @method('PUT') @endif
    <x-campo name="codigo" label="Código" :value="$producto->codigo" />
    <x-campo name="nombre" label="Nombre" :value="$producto->nombre" />
    <x-campo name="categoria" label="Categoría" :opciones="['Teléfono', 'Accesorio', 'Repuesto']" :value="$producto->categoria" />
    <x-campo name="stock" label="Stock" type="number" :value="$producto->stock ?? 0" />
    <x-campo name="precio_compra" label="Precio de compra (Q)" type="number" :value="$producto->precio_compra" />
    <x-campo name="precio_venta" label="Precio de venta (Q)" type="number" :value="$producto->precio_venta" />
    @if ($producto->exists)
        <x-campo name="estado" label="Estado" :opciones="['Activo', 'Inactivo']" :value="$producto->estado" />
    @endif
    <div class="col-12 text-end">
        <a href="{{ route('productos.index') }}" class="btn btn-light">Cancelar</a>
        <button class="btn btn-primary">Guardar</button>
    </div>
</form>
@endsection
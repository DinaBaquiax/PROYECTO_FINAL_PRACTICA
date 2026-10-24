@extends('layouts.panel')
@section('titulo', 'Productos')
@section('contenido')
<div class="d-flex justify-content-between mb-3">
    <h4>Productos y Accesorios</h4>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">+ Nuevo Producto</a>
</div>

<form class="row g-2 mb-3">
    <div class="col-md-5"><input name="q" value="{{ request('q') }}" class="form-control" placeholder="Buscar por código o nombre"></div>
    <div class="col-6 col-md-3">
        <select name="categoria" class="form-select" onchange="this.form.submit()">
            <option value="">Todas las categorías</option>
            @foreach (['Teléfono', 'Accesorio', 'Repuesto'] as $c)<option @selected(request('categoria') == $c)>{{ $c }}</option>@endforeach
        </select>
    </div>
    <div class="col-6 col-md-3">
        <select name="estado" class="form-select" onchange="this.form.submit()">
            @foreach (['Activo', 'Inactivo', 'Todos'] as $e)<option @selected(request('estado', 'Activo') == $e)>{{ $e }}</option>@endforeach
        </select>
    </div>
</form>

<div class="table-responsive">
<table class="table table-hover align-middle">
    <thead><tr><th>Código</th><th>Nombre</th><th>Categoría</th><th>Precio venta</th><th>Registrado</th><th>Estado</th><th></th></tr></thead>
    <tbody>
    @forelse ($productos as $p)
        <tr>
            <td>{{ $p->codigo }}</td><td>{{ $p->nombre }}</td><td>{{ $p->categoria }}</td>
            <td>Q {{ number_format($p->precio_venta, 2) }}</td><td>{{ $p->fecha_registro }}</td>
            <td><span class="badge text-bg-{{ $p->estado == 'Activo' ? 'success' : 'secondary' }}">{{ $p->estado }}</span></td>
            @include('partials.acciones', ['ruta' => 'productos', 'm' => $p, 'msg' => '¿Está seguro de eliminar este producto?'])
        </tr>
    @empty
        <tr><td colspan="7" class="text-center text-muted">Sin resultados</td></tr>
    @endforelse
    </tbody>
</table>
</div>
{{ $productos->links() }}
@endsection
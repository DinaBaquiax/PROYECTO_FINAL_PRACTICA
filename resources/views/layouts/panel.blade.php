<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bethel Toto · @yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar bg-white border-bottom d-lg-none px-3">
    <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#menu"><i class="bi bi-list fs-4"></i></button>
    <strong>BETHEL TOTO</strong>
</nav>

<div class="d-lg-flex">
    <aside class="offcanvas-lg offcanvas-start sidebar" id="menu">
        <h5 class="text-center py-4 m-0 fw-bold">BETHEL TOTO</h5>
        @foreach ([
            'GENERAL'        => [['inicio', 'house', 'Inicio']],
            'INVENTARIO'     => [['productos.index', 'briefcase', 'Productos y Accesorios']],
            'TALLER TÉCNICO' => [['reparaciones.index', 'wrench', 'Reparaciones'], ['precios.index', 'currency-dollar', 'Precios de servicio']],
            'REPORTES'       => [['reportes', 'file-earmark-pdf', 'Reportes en PDF']],
        ] as $seccion => $enlaces)
            <small class="px-3 mt-3 d-block fw-bold">{{ $seccion }}</small>
            @foreach ($enlaces as [$ruta, $icono, $texto])
                <a href="{{ route($ruta) }}" @class(['active' => request()->routeIs(Str::before($ruta, '.') . '*')])>
                    <i class="bi bi-{{ $icono }}"></i> {{ $texto }}
                </a>
            @endforeach
        @endforeach
        <form method="POST" action="{{ route('logout') }}" class="mt-auto p-3">
            @csrf <button class="btn btn-outline-light btn-sm w-100">Cerrar sesión</button>
        </form>
    </aside>

    <main class="flex-fill p-3 p-lg-4">@yield('contenido')</main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/panel.js') }}"></script>
@if (session('ok'))
    <script>Swal.fire({icon: 'success', title: @json(session('ok')), timer: 1800, showConfirmButton: false})</script>
@endif
@if ($errors->any())
    <script>Swal.fire({icon: 'error', title: 'Revisa los datos', html: @json(implode('<br>', array_map('e', $errors->all())))})</script>
@endif
@stack('scripts')
</body>
</html>
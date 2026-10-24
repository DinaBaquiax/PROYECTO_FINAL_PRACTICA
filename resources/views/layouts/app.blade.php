
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bethel Toto') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
        }

        .menu-lateral {
            width: 250px;
            min-height: 100vh;
            background: #123d48;
            color: white;
            padding: 25px 15px;
            flex-shrink: 0;
        }

        .nombre-tienda {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .grupo-menu {
            margin-bottom: 25px;
        }

        .titulo-menu {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .enlace-menu {
            display: block;
            padding: 11px 10px;
            margin-bottom: 5px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
        }

        .enlace-menu:hover,
        .enlace-menu.activo {
            background: #245966;
        }

        .zona-principal {
            flex: 1;
            min-width: 0;
            background: white;
        }

        .barra-superior {
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 25px;
            border-bottom: 1px solid #e5e7eb;
        }

        .contenido-principal {
            padding: 30px;
        }

        @media (max-width: 700px) {
            .menu-lateral {
                width: 180px;
                padding: 20px 10px;
            }

            .contenido-principal {
                padding: 18px;
            }
        }

        @media (max-width: 480px) {
            .menu-lateral {
                width: 140px;
                padding: 15px 7px;
            }

            .enlace-menu {
                font-size: 12px;
                padding: 10px 5px;
            }

            .contenido-principal {
                padding: 12px;
            }
        }
    </style>
</head>

<body class="antialiased">

    <div class="min-h-screen flex">

        <aside class="menu-lateral">

            <h1 class="nombre-tienda">BETHEL TOTO</h1>

            <div class="grupo-menu">
                <h2 class="titulo-menu">GENERAL</h2>

                <a href="{{ route('dashboard') }}"
                   class="enlace-menu activo">
                    🏠 Inicio
                </a>
            </div>

            <div class="grupo-menu">
                <h2 class="titulo-menu">INVENTARIO</h2>

                <a href="#" class="enlace-menu">
                    📦 Productos y Accesorios
                </a>
            </div>

            <div class="grupo-menu">
                <h2 class="titulo-menu">TALLER TÉCNICO</h2>

                <a href="#" class="enlace-menu">
                    🔧 Reparaciones
                </a>

                <a href="#" class="enlace-menu">
                    💲 Precios de servicio
                </a>
            </div>

            <div class="grupo-menu">
                <h2 class="titulo-menu">REPORTES</h2>

                <a href="#" class="enlace-menu">
                    📄 Reportes en PDF
                </a>
            </div>

        </aside>

        <div class="zona-principal">

            <header class="barra-superior">

                <span class="text-sm text-gray-500">
                    Sistema de Gestión de Inventario
                </span>

                <div class="flex items-center gap-3">

                    <span class="text-sm text-gray-700">
                        {{ Auth::user()->name ?? 'Usuario' }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="text-sm text-red-600 hover:text-red-800">
                            Cerrar sesión
                        </button>
                    </form>

                </div>

            </header>

            <main class="contenido-principal">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>
</html>

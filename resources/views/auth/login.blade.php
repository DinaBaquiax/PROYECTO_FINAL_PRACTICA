<x-guest-layout>
    <!-- Estado de la Sesión -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="w-full max-w-sm mx-auto bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        
        <!-- Encabezado del Formulario -->
        <div class="flex justify-center">
            <img src="{{ asset('logo_bethel_toto.jpg') }}" alt="Logo Bethel Toto" class="h-40 w-auto object-contain">
        </div>
        <div class="text-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Bienvenido al Sistema</h2>
            <p class="text-sm text-gray-500 mt-1">Ingresa tus credenciales para acceder</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Usuario -->
            <div>
                <x-input-label for="nombre_usuario" :value="__('Usuario')" class="text-gray-700 font-medium text-sm mb-1 block" />
                <x-text-input id="nombre_usuario" 
                    class="block w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-100 transition duration-200 shadow-sm" 
                    type="text" 
                    name="nombre_usuario" 
                    :value="old('nombre_usuario')" 
                    required 
                    autofocus 
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('nombre_usuario')" class="mt-2 text-xs text-red-600" />
            </div>

            <!-- Contraseña -->
            <div>
                <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-medium text-sm mb-1 block" />
                <x-text-input id="password" 
                    class="block w-full px-4 py-3 rounded-xl border border-gray-200 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-100 transition duration-200 shadow-sm"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
            </div>

            <!-- Botón de Entrada -->
            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    {{ __('Iniciar Sesión') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
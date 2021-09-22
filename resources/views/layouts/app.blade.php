<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-5.15.4-web/css/all.min.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
                <!-- This example requires Tailwind CSS v2.0+ -->
                <nav class="bg-gray-800">
                    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                        <div class="relative flex items-center justify-between h-16">
                           
                            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                                
                                <div class="hidden sm:block sm:ml-6">
                                    <div class="flex space-x-4">
                                        

                                           
                                                <a href="{{ route('inicio') }}" class="{{request()->routeIs('inicio') ?'text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-bold underline':'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium'}}"  class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                                    Inicio
                                                </a>
                                                <a href="{{ route('nuevafactura') }}" class="{{request()->routeIs('nuevafactura') ? 'text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-bold underline':'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium'}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                                    Nueva Factura
                                                </a>
                                                <a href="{{ route('facturas') }}"  class="{{request()->routeIs('facturas') ? 'text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-bold underline':'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium'}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                                  Facturas
                                                </a>
                                                <a href="{{ route('productos') }}" class="{{request()->routeIs('productos') ? 'text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-bold underline':'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium'}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                                    Productos
                                                </a>
                                                <a href="{{ route('estadisticas') }}" class="{{request()->routeIs('estadisticas') ? 'text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-bold underline':'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium'}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                                    Estadísticas
                                                </a>
                                          
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <!-- Mobile menu, show/hide based on menu state. -->
                    <div class="sm:hidden" id="mobile-menu">
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                           

                                <a href="{{ route('inicio') }}" active="{{request()->routeIs('inicio') ? 'true':''}}"  class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">
                                    Inicio
                                </a>
                                <a href="{{ route('nuevafactura') }}" active="{{request()->routeIs('nuevafactura') ? 'true':''}}"  class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                                    Nueva Factura
                                </a>
                                <a href="{{ route('facturas') }}" active="{{request()->routeIs('facturas') ? 'true':''}}"  class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                                  Facturas
                                </a>
                                <a href="{{ route('productos') }}" active="{{request()->routeIs('productos') ? 'true':''}}"  class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                                    Productos
                                </a>
                                <a href="{{ route('estadisticas') }}" class="{{request()->routeIs('estadisticas') ? 'text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-bold underline':'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium'}}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                    Estadísticas
                                </a>
                        </div>
                    </div>
                </nav>

            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    @stack('js')
</body>

</html>

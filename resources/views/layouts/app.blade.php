<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- SEO -->
        <x-seo />

        <link rel="icon" sizes="256x256" href="{{ asset('images/favicon.ico') }}">
        {{-- @include('meta::manager') --}}

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- CDN jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!-- wireUI -->
        <wireui:scripts />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-notifications /> 
        <x-dialog z-index="z-50" blur="md" align="center" />


            <div x-data="{ sidebarOpen: false }" class="flex flex-row min-h-screen">
                @if(Auth::user()->empresa == 'Trx' || Auth::user()->empresa == 'Banco del Tesoro')
                    {{-- Sidebar principal --}}
                    <x-sidebar-principal />
                @endif

                @if(Auth::user()->empresa == 'IAIM')   
                    {{-- Sidebar IAIM --}}
                    <x-sidebar-iaim />
                @endif

                <div class="flex-1 flex flex-col overflow-hidden">
                    <x-header-ppal></x-header-ppal>

                    <main class="main flex flex-col flex-grow  md:ml-0 transition-all duration-150 ease-in">
                        
                        {{-- Headers principal --}}
                        <div class="main-content bg-white flex flex-col flex-grow p-4">
                            <h1 class="font-bold text-2xl text-gray-700">Dashboard</h1>
                            <div class="flex flex-col flex-grow rounded mt-4">
                                {{ $slot }}
                            </div>
                        </div>

                        {{-- Footer principal --}}
                        <x-footer-ppal></x-footer-ppal>

                    </main>
                </div>
            </div>



        @stack('modals')

        @livewireScripts

        @stack('scripts')

        {{-- Utils.js --}}
        <script  src="{{ asset('js/utils.js') }}" type="text/javascript"></script>
        <script>
            var ratonParado = null;
            var milisegundosLimite = 600000;
            $(document).on('mousemove', function() {
                clearTimeout(ratonParado);
                ratonParado = setTimeout(function() {
                    $.ajax
                    ({
                        url: "{{ route('logout') }}",
                        method: 'GET',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {
                            window.$wireui.dialog({
                            title: 'Sesión inactiva!',
                            description: 'Su sesión fue cerrada por inactividad. Debe iniciar sesión nuevamente.',
                            icon: 'error'
                            })
                            console.log('cerro la sesion')
                        },
                        error: function(response) {
                            console.log(response)
                        }
                    });
                }, milisegundosLimite);
            });
        </script>

    </body>
</html>

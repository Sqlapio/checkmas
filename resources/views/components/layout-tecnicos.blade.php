<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <x-seo />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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

    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-xl sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
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


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

        <!-- Styles -->
        @livewireStyles
                
        <!-- wireUI -->
        <wireui:scripts />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-notifications />
        <x-notificaciones />

        <div class="font-sans antialiased bg-no-repeat bg-cover bg-center" style="background-image: url('{{ asset('images/fondo-registro.png') }}');">
            {{ $slot }}
        </div>
        @stack('modals')

        @livewireScripts
                
    </body>
</html>

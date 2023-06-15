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
    {{-- <x-jet-banner /> --}}

    <div class="min-h-screen">
        {{-- <div class="flex flex-row min-h-screen bg-gray-100"> --}}

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex justify-between">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <div class="flex items-center justify-end">
                                <img class="w-60 h-auto" src="{{ asset('images/check_logo.png') }}" alt="">
                              </div>
                        </div>
                    </div>

                </div>
            </div>

        <!-- Page Content -->
        <main>
            <div class="py-4">
                <div class="w-792 h-612 mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-xl sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>

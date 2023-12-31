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
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    </head>
    <body class="bg-gray-100">
        <div class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">
            @include('layouts.sidebar')

            <div class="min-h-screen flex flex-col">
                <div class="flex-grow">
                    @yield('content')
                </div>

                <div>
                    @include('layouts.footer')
                </div>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>

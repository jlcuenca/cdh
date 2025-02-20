<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Academia virtual de capacitación de los Derechos Humanos por la Comisión Estatal de Derechos Humanos del Estado de Morelos" />
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="icon" href="/ms-icon-310x310-1-100x100.png" sizes="32x32" />
        <link rel="icon" href="/ms-icon-310x310-1-300x300.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="/ms-icon-310x310-1-300x300.png" />
        <meta name="msapplication-TileImage" content="/ms-icon-310x310-1-300x300.png" />

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia

        @env ('local')
            <script src="http://localhost:8080/js/bundle.js"></script>
        @endenv
    </body>
</html>

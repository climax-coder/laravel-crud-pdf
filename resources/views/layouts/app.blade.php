<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->

    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <footer>
            <!-- Footer content -->
        </footer>
    </div>
</body>

</html>
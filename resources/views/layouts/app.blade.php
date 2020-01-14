<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-white antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans text-lg font-normal tracking-tight leading-relaxed text-black">
    <div id="app">
        @yield('content')
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('partials.header')
</head>
<body>
    @include('partials.nav')
    <div class="container mt-5">
        @yield('content')
    </div>
    @include('partials.script')
    @include('partials.footer')
</body>
</html>
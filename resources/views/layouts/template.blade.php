<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('css_after')
    <title>@yield('title', 'The Vinyl Shop')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#8a8a8a">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

{{--  Navigation  --}}
@include('shared.navigation')

<main class="container mt-3">
    @yield('main', 'Page under construction ...')
</main>

{{--  Footer  --}}
@include('shared.footer')

<script src="{{ mix('js/app.js') }}"></script>
@yield('script_after')

</body>
</html>

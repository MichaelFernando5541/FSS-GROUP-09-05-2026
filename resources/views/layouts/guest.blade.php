<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800,900" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased">
        {{ $slot }}
    </body>
</html>
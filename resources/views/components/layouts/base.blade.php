<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    {{ seo()->render() }}
    @googlefonts
    @filamentStyles
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body>
{{ $slot }}
@vite('resources/js/app.js')
@livewireScripts
@filamentScripts
@livewire('notifications')
<x-impersonate::banner style="dark" />
</body>
</html>

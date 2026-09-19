<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Progres Ormawa') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <style>[x-cloak]{display:none!important}</style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-slate-900 flex h-screen overflow-hidden"
          x-data="{ sidebarOpen: false }"
          @keydown.window.escape="sidebarOpen = false">
        <x-sidebar />

        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-white rounded-tl-2xl shadow-[-5px_0_15px_-5px_rgba(0,0,0,0.05)] border-l border-slate-200 my-1 md:ml-64">
            <x-topbar />

            <div class="flex-1 overflow-y-auto p-8 bg-[#F8FAFC]">
                {{ $slot }}
            </div>
        </main>

        @livewireScripts
    </body>
</html>

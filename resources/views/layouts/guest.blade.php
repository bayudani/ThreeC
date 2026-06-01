<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Three-C') }} | Login</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-800 relative overflow-hidden items-center justify-center">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-white rounded-full opacity-5 blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white rounded-full opacity-5 blur-3xl"></div>
                <div class="text-center px-12 relative z-10">
                    <img src="{{ asset('images/logo.png') }}" alt="Three-C" class="h-28 mx-auto ">
                    <h1 class="text-4xl font-extrabold text-white mt-6">Three<span class="text-blue-200">C</span></h1>
                    <p class="text-blue-100 text-lg mt-2 font-medium">Cakra Control Center</p>
                    <p class="text-blue-200/70 text-sm mt-4 max-w-md leading-relaxed">
                        Sistem Informasi Manajemen untuk Monitoring, Evaluasi, dan Pelaporan Program Kerja Organisasi Mahasiswa.
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center px-4 sm:px-6 py-8 sm:py-12 bg-[#F8FAFC]">
                <div class="w-full max-w-md">
                    <div class="text-center mb-6 sm:mb-8 lg:hidden">
                        <img src="{{ asset('images/logo.png') }}" alt="Three-C" class="h-14 sm:h-16 mx-auto">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-blue-700 mt-2 sm:mt-3">Three<span class="text-slate-800">C</span></h1>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">Cakra Control Center</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8">
                        <div class="mb-5 sm:mb-6">
                            <h2 class="text-lg sm:text-xl font-bold text-slate-800">Selamat Datang</h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">Silakan masuk ke akun Anda</p>
                        </div>
                        {{ $slot }}
                    </div>

                    <p class="text-center text-xs text-slate-400 mt-6">
                        &copy; {{ date('Y') }} Three-C. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>

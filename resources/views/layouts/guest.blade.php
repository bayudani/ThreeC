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
    <body class="font-sans antialiased text-slate-900 bg-slate-50">
        <div class="min-h-screen flex w-full">
            
            <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center transform scale-105" style="background-image: url('{{ asset('images/bg.jpeg') }}');"></div>
                
                <div class="absolute inset-0 bg-gradient-to-br from-blue-950/90 via-slate-900/80 to-indigo-950/90 mix-blend-multiply"></div>
                
                <div class="relative z-10 w-full max-w-lg p-12 mx-8 bg-white/10 backdrop-blur-md border border-white/20 rounded-[2.5rem] shadow-2xl">
                    <div class="w-20 h-20 bg-white/95 backdrop-blur flex items-center justify-center rounded-2xl shadow-xl mb-8 border border-white/50">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Three-C" class="h-14 w-14 object-contain">
                    </div>
                    
                    <h1 class="text-5xl font-extrabold text-white tracking-tight mb-3">
                        Three<span class="text-blue-400"> - C</span>
                    </h1>
                    <h2 class="text-xl text-blue-100 font-semibold mb-6 tracking-wide uppercase">Cakra Control Center</h2>
                    
                    <div class="w-16 h-1.5 bg-blue-500 rounded-full mb-8"></div>
                    
                    <p class="text-blue-50/90 text-lg leading-relaxed font-medium">
                        Sistem Informasi Manajemen terpadu untuk Monitoring, Evaluasi, dan Pelaporan Program Kerja Organisasi Mahasiswa secara real-time dan transparan.
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-indigo-400/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="w-full max-w-md relative z-10">
                    <div class="text-center mb-10 lg:hidden">
                        <div class="w-20 h-20 bg-white flex items-center justify-center rounded-2xl shadow-sm border border-slate-200 mx-auto mb-5">
                            <img src="{{ asset('images/logo.png') }}" alt="Three-C" class="h-12 w-12 object-contain">
                        </div>
                        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Three<span class="text-blue-600">C</span></h1>
                        <p class="text-sm font-bold text-slate-500 mt-2 tracking-wide uppercase">Cakra Control Center</p>
                    </div>

                    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 p-8 sm:p-10 border border-slate-100/60">
                        <div class="mb-8 text-center sm:text-left">
                            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang </h2>
                            <p class="text-sm text-slate-500 mt-2">Silakan masuk menggunakan kredensial Anda untuk melanjutkan.</p>
                        </div>
                        
                        {{ $slot }}
                        
                    </div>

                    <p class="text-center text-sm text-slate-400 mt-10 font-medium">
                        &copy; {{ date('Y') }} <span class="text-slate-600 font-bold">Three-C Ecosystem</span>.
                    </p>
                </div>
            </div>
            
        </div>
    </body>
</html>
@php
    $route = request()->route()?->getName();
    $role = Auth::user()->role;
    $isAdmin = $role === 'admin_kampus';

    $navItems = [
        'Dashboard' => [
            'route' => $isAdmin ? 'admin.dashboard' : 'ormawa.dashboard',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>',
            'active' => str_contains($route ?? '', 'dashboard'),
        ],
        'Manajemen Ormawa' => [
            'route' => 'admin.ormawa',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
            'active' => str_contains($route ?? '', 'ormawa') && !str_contains($route ?? '', 'dashboard'),
            'admin_only' => true,
        ],
        'Program Kerja' => [
            'route' => $isAdmin ? 'admin.proker' : 'ormawa.proker',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>',
            'active' => str_contains($route ?? '', 'proker') && !str_contains($route ?? '', 'laporan'),
        ],
        'Monev & Evaluasi' => [
            'route' => 'admin.evaluasi',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
            'active' => str_contains($route ?? '', 'evaluasi'),
            'admin_only' => true,
        ],
        'Dokumentasi' => [
            'route' =>  'admin.laporan',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
            'active' => str_contains($route ?? '', 'laporan') && !str_contains($route ?? '', 'evaluasi'),
            'admin_only' => true,
        ],
        'Pengumuman' => [
            'route' => 'admin.pengumuman',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h5m5 0h5a2 2 0 002-2V7a2 2 0 00-2-2h-5m0 0L9 5m5 0l-5 0"></path></svg>',
            'active' => str_contains($route ?? '', 'pengumuman'),
            'admin_only' => true,
        ],
    ];
@endphp

<aside
    class="fixed inset-y-0 left-0 z-40 w-64 bg-[#0f172a] text-slate-300 flex flex-col transition-all duration-300 ease-in-out md:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full'"
>
    <!-- Header Section -->
    <div class="h-20 flex items-center gap-3 px-6 shrink-0 pt-4 pb-2">
        <!-- Logo Wrapper (Diberi bg biru supaya mirip referensi icon square) -->
        <div class="w-9 h-9 bg-blue-600 rounded flex items-center justify-center shrink-0 shadow-sm overflow-hidden">
            <img src="{{ asset('images/logo.png') }}" alt="Three-C" class="h-6 w-6 object-contain">
        </div>
        <div class="flex flex-col justify-center">
            <h1 class="text-[17px] font-medium text-white tracking-wide leading-none">Three-C</h1>
            <p class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1.5 leading-none">Management Center</p>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-4 space-y-1 scrollbar-thin mt-2">
        @foreach($navItems as $label => $item)
            @if(!empty($item['admin_only']) && !$isAdmin)
                @continue
            @endif
            <a href="{{ route($item['route']) }}"
                class="group flex items-center gap-4 px-6 py-3.5 text-[15px] transition-all duration-200
                {{ $item['active']
                    ? 'bg-[#1e293b] text-white border-l-4 border-blue-500 shadow-sm'
                    : 'text-slate-400 border-l-4 border-transparent hover:bg-slate-800/50 hover:text-slate-200' }}">
                <span class="shrink-0 transition-colors {{ $item['active'] ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}">
                    {!! $item['icon'] !!}
                </span>
                <span class="font-normal">{{ $label }}</span>
            </a>
        @endforeach
    </nav>

    <!-- Footer Area (Hanya Logout Karena Profile Pindah ke Topbar) -->
    <div class="p-4 shrink-0 mt-auto border-t border-slate-800">
        <!-- Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-4 px-3 py-3 text-[15px] font-normal text-slate-400 hover:text-red-400 hover:bg-slate-800/50 rounded-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Mobile Overlay -->
<div
    class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm md:hidden"
    x-show="sidebarOpen"
    x-cloak
    @click="sidebarOpen = false"
    x-transition:enter="transition-opacity duration-300"
    x-transition:leave="transition-opacity duration-200"
></div>
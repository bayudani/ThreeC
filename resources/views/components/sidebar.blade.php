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
            'route' => $isAdmin ? 'admin.laporan' : 'ormawa.laporan',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
            'active' => str_contains($route ?? '', 'laporan') && !str_contains($route ?? '', 'evaluasi'),
        ],
        'Pengumuman' => [
            'route' => 'admin.pengumuman',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h5m5 0h5a2 2 0 002-2V7a2 2 0 00-2-2h-5m0 0L9 5m5 0l-5 0"></path></svg>',
            'active' => str_contains($route ?? '', 'pengumuman'),
            'admin_only' => true,
        ],
    ];

    $userLabel = $isAdmin ? 'Admin Kampus' : 'Admin Ormawa';
    $userInitial = substr(Auth::user()->name, 0, 1);
@endphp

<aside
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-200 flex flex-col transition-all duration-300 ease-in-out md:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full'"
>
    <div class="h-16 flex items-center gap-2.5 px-5 border-b border-slate-100 shrink-0">
        <img src="{{ asset('images/logo.png') }}" alt="Three-C" class="h-9 w-9 object-contain">
        <div>
            <h1 class="text-lg font-extrabold text-blue-700 leading-tight">Three<span class="text-slate-800"> - C</span></h1>
            <p class="text-[10px] font-medium text-slate-400 leading-tight -mt-0.5">Cakra Control Center</p>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5 scrollbar-thin">
        @foreach($navItems as $label => $item)
            @if(!empty($item['admin_only']) && !$isAdmin)
                @continue
            @endif
            <a href="{{ route($item['route']) }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                {{ $item['active']
                    ? 'bg-blue-50 text-blue-700 shadow-sm'
                    : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100' }}">
                <span class="shrink-0 {{ $item['active'] ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}">
                    {!! $item['icon'] !!}
                </span>
                <span>{{ $label }}</span>
                @if($item['active'])
                <span class="ml-auto w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                @endif
            </a>
        @endforeach
    </nav>

    <div class="border-t border-slate-100 p-3 space-y-2 shrink-0">
        <a href="{{ route('profile') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
            {{ str_contains($route ?? '', 'profile') ? 'bg-blue-50' : 'hover:bg-slate-50' }}">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shrink-0 shadow-sm">
                {{ $userInitial }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-slate-800 leading-tight truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ $userLabel }}</p>
            </div>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<div
    class="fixed inset-0 z-30 bg-black/30 backdrop-blur-sm md:hidden"
    x-show="sidebarOpen"
    x-cloak
    @click="sidebarOpen = false"
    x-transition:enter="transition-opacity duration-300"
    x-transition:leave="transition-opacity duration-200"
></div>

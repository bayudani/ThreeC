@php
    $role = Auth::user()->role ?? '';
    $isAdmin = $role === 'admin_kampus';
    $userLabel = $isAdmin ? 'Admin Kampus' : 'Admin Ormawa';
    $userInitial = substr(Auth::user()->name, 0, 1);
@endphp

<header class="h-16 flex items-center justify-between px-4 md:px-8 border-b border-slate-200 bg-white z-10 rounded-tl-2xl">
    <!-- Left Side: Toggle Sidebar & Search Bar -->
    <div class="flex items-center gap-3 flex-1">
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="md:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors"
            aria-label="Toggle sidebar"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <div class="w-full max-w-md">
            @livewire('topbar-search')
        </div>
    </div>

    <!-- Right Side: Profile (Sesuai referensi gambar) -->
    <div class="flex items-center border-l border-slate-200 pl-4 ml-4 h-8">
        <a href="{{ route('profile') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
            <div class="hidden md:flex flex-col items-end text-right">
                <span class="text-[13px] font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</span>
                <span class="text-[11px] font-medium text-slate-500">{{ $userLabel }}</span>
            </div>
            
            <div class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center overflow-hidden border border-slate-200">
                <!-- Kalau nanti ada fitur upload foto, fotonya taro di sini -->
                {{-- <img src="{{ asset('path/to/profile.jpg') }}" alt="Profile" class="w-full h-full object-cover"> --}}
                
                <!-- Fallback inisial nama -->
                <div class="w-full h-full bg-[#0f172a] flex items-center justify-center text-white font-bold text-sm">
                    {{ $userInitial }}
                </div>
            </div>
        </a>
    </div>
</header>
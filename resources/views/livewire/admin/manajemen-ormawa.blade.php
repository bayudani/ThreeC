<div class="max-w-7xl mx-auto space-y-6">
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-xl text-sm font-medium shadow-sm">
            <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-8 h-8 bg-blue-600/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Manajemen Ormawa</h2>
                    <p class="text-sm text-slate-500">Kelola data seluruh Organisasi Mahasiswa di kampus</p>
                </div>
            </div>
        </div>
        <button wire:click="tambah" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Ormawa
        </button>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-full -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Ormawa</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1.5">{{ $stats['total'] }}</h3>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/5 rounded-full -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Legislatif</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1.5">{{ $stats['legislatif'] }}</h3>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-full -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Eksekutif</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1.5">{{ $stats['eksekutif'] }}</h3>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-violet-500/5 rounded-full -translate-y-8 translate-x-8"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-violet-100 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">UKM</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1.5">{{ $stats['ukm'] }}</h3>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex items-center gap-1.5 flex-wrap">
            <button wire:click="setKategori('')"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ $filterKategori === '' ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' : 'text-slate-600 hover:bg-slate-100' }}">
                Semua
            </button>
            <button wire:click="setKategori('Legislatif')"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ $filterKategori === 'Legislatif' ? 'bg-amber-500 text-white shadow-sm shadow-amber-200' : 'text-slate-600 hover:bg-slate-100' }}">
                Legislatif
            </button>
            <button wire:click="setKategori('Eksekutif')"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ $filterKategori === 'Eksekutif' ? 'bg-emerald-500 text-white shadow-sm shadow-emerald-200' : 'text-slate-600 hover:bg-slate-100' }}">
                Eksekutif
            </button>
            <button wire:click="setKategori('UKM')"
                class="px-4 py-2 text-sm font-medium rounded-lg transition-all {{ $filterKategori === 'UKM' ? 'bg-violet-500 text-white shadow-sm shadow-violet-200' : 'text-slate-600 hover:bg-slate-100' }}">
                UKM
            </button>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-64">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full pl-9 p-2.5 placeholder:text-slate-400"
                    placeholder="Cari nama ormawa...">
            </div>

            <div class="flex bg-slate-100 p-1 rounded-lg border border-slate-200">
                <button wire:click="setViewMode('card')"
                    class="p-2 rounded-md transition-all {{ $viewMode === 'card' ? 'bg-white shadow-sm text-blue-600 ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </button>
                <button wire:click="setViewMode('table')"
                    class="p-2 rounded-md transition-all {{ $viewMode === 'table' ? 'bg-white shadow-sm text-blue-600 ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>

    @if($viewMode === 'card')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($ormawas as $ormawa)
                <div class="group bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <div class="h-36 bg-slate-50 relative flex items-center justify-center p-6 overflow-hidden">
                        @if($ormawa->logo)
                            <img src="{{ $ormawa->logoUrl() }}" alt="{{ $ormawa->nama }}" class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">
                                <span class="text-2xl font-bold text-white">{{ substr($ormawa->nama, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 px-2.5 py-1 text-[10px] font-bold rounded-full shadow-sm backdrop-blur {{ $ormawa->kategori === 'Legislatif' ? 'bg-amber-50 text-amber-700 border border-amber-200' : ($ormawa->kategori === 'Eksekutif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-violet-50 text-violet-700 border border-violet-200') }}">
                            {{ $ormawa->kategori }}
                        </span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-base font-bold text-slate-800 line-clamp-1" title="{{ $ormawa->nama }}">{{ $ormawa->nama }}</h3>
                        <p class="text-sm text-slate-500 mt-0.5">{{ $ormawa->fakultas ?? 'Universitas' }}</p>

                        <div class="mt-4 flex items-center gap-3">
                            <div class="flex items-center gap-1.5 text-xs text-slate-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $ormawa->periode ?? '2024-2025' }}
                            </div>
                            @if($ormawa->admin_password !== '-')
                                <div class="flex items-center gap-1.5 text-xs text-slate-400" x-data="{ show: false }">
                                    <button @click="show = !show" class="inline-flex items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors">
                                        <span x-show="!show" class="font-mono tracking-wider text-[10px]">••••••••</span>
                                        <span x-show="show" class="font-mono text-[11px] text-slate-600">{{ $ormawa->admin_password }}</span>
                                        <svg x-show="!show" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg x-show="show" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878l4.242-4.242m4.242 4.242L21 21"></path></svg>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="mt-auto pt-4 flex items-center gap-2">
                            <button wire:click="edit({{ $ormawa->id }})" class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-medium rounded-lg transition-all">
                                Edit
                            </button>
                            <button wire:click="confirmDelete({{ $ormawa->id }})" class="p-2 border border-slate-300 hover:bg-red-50 hover:text-red-600 hover:border-red-200 text-slate-500 rounded-lg transition-all active:scale-[0.97]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($ormawas->onFirstPage() && $search === '' && $filterKategori === '')
                <button wire:click="tambah"
                    class="group bg-slate-50/50 rounded-xl border-2 border-dashed border-slate-300 hover:border-blue-400 hover:bg-blue-50/40 transition-all flex flex-col items-center justify-center p-6 min-h-[350px] text-slate-500 hover:text-blue-600">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-4 border border-slate-200 group-hover:border-blue-200 group-hover:shadow-md transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="font-semibold text-slate-700 group-hover:text-blue-700">Daftarkan Ormawa Baru</span>
                    <span class="text-sm text-center mt-1 text-slate-400 group-hover:text-blue-500">Mulai proses pendaftaran resmi</span>
                </button>
            @endif
        </div>
    @else
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Logo</th>
                            <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Nama Organisasi</th>
                            <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Kategori</th>
                            <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Fakultas</th>
                            <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Periode</th>
                            <th scope="col" class="px-6 py-4 font-semibold tracking-wider">Password</th>
                            <th scope="col" class="px-6 py-4 text-right font-semibold tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ormawas as $ormawa)
                            <tr class="bg-white border-b border-slate-100 hover:bg-blue-50/30 transition-colors">
                                <td class="px-6 py-4">
                                    @if($ormawa->logo)
                                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-slate-200 bg-slate-50">
                                            <img src="{{ $ormawa->logoUrl() }}" alt="{{ $ormawa->nama }}" class="w-full h-full object-contain">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                            {{ substr($ormawa->nama, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-slate-800">{{ $ormawa->nama }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full {{ $ormawa->kategori === 'Legislatif' ? 'bg-amber-50 text-amber-700 border border-amber-200' : ($ormawa->kategori === 'Eksekutif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-violet-50 text-violet-700 border border-violet-200') }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $ormawa->kategori === 'Legislatif' ? 'bg-amber-500' : ($ormawa->kategori === 'Eksekutif' ? 'bg-emerald-500' : 'bg-violet-500') }}"></span>
                                        {{ $ormawa->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $ormawa->fakultas ?? 'Universitas' }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $ormawa->periode ?? '2024-2025' }}</td>
                                <td class="px-6 py-4" x-data="{ show: false }">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-mono {{ $ormawa->admin_password === '-' ? 'text-slate-400' : 'text-slate-700' }}">
                                            <span x-show="show">{{ $ormawa->admin_password }}</span>
                                            <span x-show="!show" class="select-none tracking-widest">••••••••••••</span>
                                        </span>
                                        @if($ormawa->admin_password !== '-')
                                            <button @click="show = !show" class="text-slate-400 hover:text-slate-600 transition-colors">
                                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878l4.242-4.242m4.242 4.242L21 21"></path></svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button wire:click="edit({{ $ormawa->id }})"
                                            class="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $ormawa->id }})"
                                            class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <p class="text-base font-semibold text-slate-600">Tidak ada data ormawa</p>
                                        <p class="text-sm text-slate-400 mt-1">Belum ada organisasi yang terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-2">
        {{ $ormawas->links(data: ['scrollTo' => false]) }}
    </div>

    {{-- Modal Form --}}
    @if($showForm)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto" @click.away="if(!$event.target.closest('.modal-content')) batal()">
                <div class="flex items-center justify-between p-6 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $editId ? 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' : 'M12 6v6m0 0v6m0-6h6m-6 0H6' }}"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">{{ $editId ? 'Edit Ormawa' : 'Tambah Ormawa' }}</h3>
                    </div>
                    <button wire:click="batal" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit="save" class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Organisasi</label>
                        <input wire:model="nama" type="text" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm px-3 py-2.5" placeholder="Masukkan nama ormawa">
                        @error('nama') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori</label>
                        <select wire:model="kategori" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm px-3 py-2.5">
                            <option value="">Pilih kategori</option>
                            <option value="Legislatif">Legislatif</option>
                            <option value="Eksekutif">Eksekutif</option>
                            <option value="UKM">UKM</option>
                        </select>
                        @error('kategori') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Fakultas</label>
                            <input wire:model="fakultas" type="text" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm px-3 py-2.5" placeholder="Contoh: FTI">
                            @error('fakultas') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Periode</label>
                            <input wire:model="periode" type="text" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm px-3 py-2.5" placeholder="2024-2025">
                            @error('periode') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Logo Organisasi</label>
                        <div class="relative">
                            <input wire:model="logo" type="file" accept="image/*"
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        </div>
                        @error('logo') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror

                        @if($logo && !$errors->has('logo'))
                            <div class="mt-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <img src="{{ $logo->temporaryUrl() }}" class="h-24 w-auto object-contain rounded mx-auto">
                            </div>
                        @elseif($existingLogo)
                            <div class="mt-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                <img src="{{ Storage::url($existingLogo) }}" class="h-24 w-auto object-contain rounded mx-auto">
                                <p class="text-xs text-slate-400 text-center mt-2">Logo saat ini</p>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                        <button type="button" wire:click="batal" class="px-5 py-2.5 border border-slate-300 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-all">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                            {{ $editId ? 'Simpan Perubahan' : 'Tambah Ormawa' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal Hapus --}}
    @if($confirmDeleteId)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 text-center">
                <div class="w-16 h-16 mx-auto bg-red-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Ormawa?</h3>
                <p class="text-sm text-slate-500 mb-7">Data ormawa dan seluruh program kerjanya akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
                <div class="flex justify-center gap-3">
                    <button wire:click="batalHapus" class="px-5 py-2.5 border border-slate-300 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-all">Batal</button>
                    <button wire:click="delete" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm">Ya, Hapus</button>
                </div>
            </div>
        </div>
    @endif
</div>
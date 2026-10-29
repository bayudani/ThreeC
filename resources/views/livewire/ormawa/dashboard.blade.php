<div class="max-w-7xl mx-auto space-y-8">

    {{-- Success Toast --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.300ms class="fixed top-4 right-4 z-50 max-w-sm bg-white rounded-2xl shadow-lg border border-emerald-100 p-4 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800">Berhasil!</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-9 h-9 bg-blue-600/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Selamat Datang, {{ Auth::user()->name }}</h2>
                    <p class="text-sm text-slate-500">Pantau dan kendalikan program kerja organisasi Anda</p>
                </div>
            </div>
        </div>
        <button wire:click="openModal" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Buat Program Baru
        </button>
    </div>

    {{-- Metric Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Program</p>
                    <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $metrics['total'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-0.5">{{ $metrics['selesai'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Berjalan</p>
                    <p class="text-2xl font-bold text-amber-600 mt-0.5">{{ $metrics['berjalan'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192-3 1.732-3z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Laporan Tertunda</p>
                    <p class="text-2xl font-bold text-rose-600 mt-0.5">{{ $metrics['tertunda'] }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content: 2 Columns --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: Proker Terkini --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-blue-100 rounded-md flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-700">Program Kerja Terkini</h3>
                </div>
                <a href="{{ route('ormawa.proker') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($prokerTerkini as $proker)
                    @php
                        // Gunakan computed accessor untuk status dinamis
                        $computedStatus = $proker->computed_status;
                        $computedProgress = $proker->computed_progress;
                        
                        $barColor = match($computedStatus) {
                            'selesai' => 'bg-emerald-500',
                            'berjalan' => 'bg-blue-500',
                            'ditolak' => 'bg-red-500',
                            'menunggu_persetujuan' => 'bg-amber-500',
                            default => 'bg-slate-400',
                        };
                        $badgeColor = match($computedStatus) {
                            'selesai' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                            'berjalan' => 'bg-blue-50 text-blue-700 border border-blue-200',
                            'ditolak' => 'bg-red-50 text-red-700 border border-red-200',
                            'menunggu_persetujuan' => 'bg-amber-50 text-amber-700 border border-amber-200',
                            default => 'bg-slate-50 text-slate-600 border border-slate-200',
                        };
                        $label = match($computedStatus) {
                            'selesai' => 'Selesai',
                            'berjalan' => 'Berjalan',
                            'ditolak' => 'Ditolak',
                            'menunggu_persetujuan' => 'Menunggu Persetujuan',
                            default => 'Belum Dimulai',
                        };
                    @endphp
                    <div class="px-6 py-4 hover:bg-blue-50/20 transition-colors">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="min-w-0 flex-1">
                                <h4 class="font-semibold text-slate-800 text-sm">{{ $proker->nama_proker }}</h4>
                                <p class="text-xs text-slate-400 mt-0.5 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M Y') }}
                                </p>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-semibold rounded-md {{ $badgeColor }} shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full {{ str_replace('bg-', '', $barColor) }}"></span>
                                {{ $label }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex-1 bg-slate-100 rounded-full h-2 overflow-hidden">
                                <div class="{{ $barColor }} h-2 rounded-full transition-all duration-500" style="width: {{ $computedProgress }}%"></div>
                            </div>
                            <span class="text-xs font-bold text-slate-600 tabular-nums">{{ $computedProgress }}%</span>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-16 text-center">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <p class="text-base font-semibold text-slate-600">Belum ada program kerja</p>
                        <p class="text-sm text-slate-400 mt-1">Mulai dengan membuat program kerja baru</p>
                        <button wire:click="openModal" class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 bg-blue-50 text-blue-700 font-semibold text-sm rounded-lg hover:bg-blue-100 transition-colors border border-blue-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Buat Program
                        </button>
                    </div>
                @endforelse
            </div>

            @if($prokerTerkini->count() > 0)
                <div class="px-6 py-3 bg-slate-50/50 border-t border-slate-100 text-center">
                    <a href="{{ route('ormawa.proker') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                        Lihat semua {{ $metrics['total'] }} program kerja
                    </a>
                </div>
            @endif
        </div>

        {{-- Right: Pengumuman --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                <div class="w-6 h-6 bg-amber-100 rounded-md flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-700">Pengumuman Kampus</h3>
            </div>

            <div class="p-5 space-y-3 max-h-[480px] overflow-y-auto">
                @forelse($pengumumans as $pengumuman)
                    @php
                        $type = match($pengumuman->tipe) {
                            'mendesak' => ['dot' => 'bg-rose-500', 'text' => 'text-rose-600', 'label' => 'Mendesak'],
                            'info' => ['dot' => 'bg-blue-500', 'text' => 'text-blue-600', 'label' => 'Info'],
                            'kegiatan' => ['dot' => 'bg-emerald-500', 'text' => 'text-emerald-600', 'label' => 'Kegiatan'],
                            default => ['dot' => 'bg-slate-400', 'text' => 'text-slate-500', 'label' => 'Info'],
                        };
                    @endphp
                    <button wire:click="openPengumumanModal({{ $pengumuman->id }})" class="w-full bg-white rounded-xl border border-slate-200 p-4 transition-all hover:border-slate-300 hover:shadow-sm text-left">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full {{ $type['dot'] }}"></span>
                            <span class="text-[11px] font-bold uppercase tracking-wide {{ $type['text'] }}">{{ $type['label'] }}</span>
                            <span class="ml-auto text-[11px] text-slate-400">{{ $pengumuman->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800 mb-1">{{ $pengumuman->judul }}</h4>
                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">{{ $pengumuman->isi }}</p>
                    </button>
                @empty
                    <div class="text-center py-10">
                        <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        </div>
                        <p class="text-sm font-medium text-slate-500">Belum ada pengumuman</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Section: Kontak Mendagri --}}
    @if(isset($footerKontaks) && $footerKontaks->count() > 0)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                <div class="w-6 h-6 bg-blue-100 rounded-md flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-700">Kontak Mendagri</h3>
            </div>
            <div class="p-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($footerKontaks as $kontak)
                        @php
                            $iconSvg = match($kontak->icon) {
                                'email' => '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
                                'whatsapp' => '<svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>',
                                'instagram' => '<svg class="w-5 h-5 text-rose-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>',
                                'tiktok' => '<svg class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"></path></svg>',
                                'telepon' => '<svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>',
                                'website' => '<svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>',
                                default => '<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                            };
                            $href = match($kontak->icon) {
                                'email' => 'mailto:' . $kontak->value,
                                'whatsapp' => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $kontak->value),
                                'instagram' => 'https://instagram.com/' . ltrim($kontak->value, '@'),
                                'tiktok' => 'https://tiktok.com/@' . ltrim($kontak->value, '@'),
                                'telepon' => 'tel:' . preg_replace('/[^0-9+]/', '', $kontak->value),
                                'website' => $kontak->value,
                                default => '#',
                            };
                            $isExternal = in_array($kontak->icon, ['whatsapp', 'instagram', 'tiktok', 'website']);
                        @endphp
                        <a href="{{ $href }}" {{ $isExternal ? 'target="_blank"' : '' }} class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-sm transition-all">
                            <div class="w-10 h-10 rounded-lg bg-white shadow-sm border border-slate-200 flex items-center justify-center shrink-0">
                                {!! $iconSvg !!}
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">{{ $kontak->label }}</p>
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $kontak->value }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <p class="text-xs text-slate-400 mt-4">Hubungi admin kemahasiswaan untuk pertanyaan terkait program kerja, validasi, dan laporan.</p>
            </div>
        </div>
    @endif

    {{-- MODAL BUAT PROGRAM KERJA BARU --}}
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" wire:key="create-modal">
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Buat Program Kerja Baru</h3>
                    </div>
                    <button wire:click="closeModal" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="simpanProker" class="p-6 space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Nama Program <span class="text-red-500">*</span></label>
                        <input wire:model="nama_proker" type="text" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Contoh: Seminar Nasional Teknologi 2026">
                        @error('nama_proker') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea wire:model="deskripsi" rows="3" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Jelaskan secara singkat tujuan program kerja ini..."></textarea>
                        @error('deskripsi') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Target Pelaksanaan <span class="text-red-500">*</span></label>
                        <input wire:model="target_waktu" type="date" min="{{ date('Y-m-d') }}" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all">
                        @error('target_waktu') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-[0.97] rounded-lg transition-all shadow-sm flex items-center gap-2">
                            <span wire:loading.remove wire:target="simpanProker">Simpan Program</span>
                            <span wire:loading wire:target="simpanProker" style="display: none;">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- MODAL PENGUMUMAN DETAIL --}}
    @if($showPengumumanModal && $selectedPengumuman)
        @php
            $modalType = match($selectedPengumuman->tipe) {
                'mendesak' => ['bg' => 'bg-rose-100', 'icon' => 'text-rose-600', 'badge' => 'bg-rose-50 text-rose-700 border-rose-200', 'dot' => 'bg-rose-500', 'label' => 'Mendesak'],
                'kegiatan' => ['bg' => 'bg-emerald-100', 'icon' => 'text-emerald-600', 'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-500', 'label' => 'Kegiatan'],
                default => ['bg' => 'bg-blue-100', 'icon' => 'text-blue-600', 'badge' => 'bg-blue-50 text-blue-700 border-blue-200', 'dot' => 'bg-blue-500', 'label' => 'Info'],
            };
        @endphp
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" wire:key="pengumuman-modal">
            <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-slate-200">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 {{ $modalType['bg'] }} rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 {{ $modalType['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Pengumuman</h3>
                    </div>
                    <button wire:click="closePengumumanModal" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-lg {{ $modalType['badge'] }} border">
                            <span class="w-1.5 h-1.5 rounded-full {{ $modalType['dot'] }}"></span>
                            {{ $modalType['label'] }}
                        </span>
                        <span class="text-xs text-slate-400">{{ $selectedPengumuman->created_at->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 leading-tight break-words">{{ $selectedPengumuman->judul }}</h4>
                    <div class="prose prose-sm prose-slate max-w-none">
                        <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap break-words">{{ $selectedPengumuman->isi }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-end px-6 py-4 border-t border-slate-200">
                    <button wire:click="closePengumumanModal" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
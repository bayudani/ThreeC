<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-navy-800 tracking-tight">Program Kerja</h2>
            <p class="text-sm text-slate-500 mt-1">Pemantauan inisiatif strategis dan kegiatan seluruh ormawa.</p>
        </div>
        <button class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md active:scale-[0.98]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export Laporan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <div class="md:col-span-5 relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 p-6 shadow-md">
            <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute -left-4 -bottom-4 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
            <div class="relative z-10 flex flex-col h-full">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-2.5 py-1 bg-white/15 text-white/90 text-[10px] font-bold tracking-wider rounded-lg uppercase backdrop-blur-sm">Performa Kuartal Ini</span>
                </div>
                <div class="flex items-end gap-6 mt-auto">
                    <div class="relative">
                        <svg class="w-28 h-28 -rotate-90" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="white" stroke-width="6" class="opacity-15" />
                            <circle cx="60" cy="60" r="52" fill="none" stroke="white" stroke-width="6" stroke-dasharray="326.73" stroke-dashoffset="{{ 326.73 - (326.73 * $stats['successRate'] / 100) }}" stroke-linecap="round" class="drop-shadow-lg transition-all duration-1000" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-4xl font-extrabold text-white drop-shadow-sm">{{ $stats['successRate'] }}%</span>
                        </div>
                    </div>
                    <div class="pb-2">
                        <p class="text-lg font-semibold text-white">Tingkat Keberhasilan</p>
                        <p class="text-sm text-primary-200 mt-0.5">Proker yang memenuhi target kampus</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-3 bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div class="flex items-start justify-between">
                <div class="w-11 h-11 rounded-xl bg-blue-50 text-primary-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <span class="px-2.5 py-1 bg-blue-50 text-primary-600 text-[10px] font-bold rounded-lg uppercase tracking-wider">Aktif</span>
            </div>
            <div class="mt-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Proker Berjalan</p>
                <p class="text-4xl font-extrabold text-navy-800 mt-1">{{ $stats['berjalan'] }}</p>
                <p class="text-xs text-slate-400 mt-1">Program yang sedang dilaksanakan</p>
            </div>
        </div>

        <div class="md:col-span-4 bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-start justify-between">
                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="px-2.5 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-lg uppercase tracking-wider">Pending</span>
            </div>
            <div class="mt-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Dimulai / Tertunda</p>
                <p class="text-4xl font-extrabold text-navy-800 mt-1">{{ $stats['tertunda'] }}</p>
                <p class="text-xs text-slate-400 mt-1">Menunggu eksekusi atau dijadwalkan ulang</p>
            </div>
            @php
                $totalStats = $stats['berjalan'] + $stats['tertunda'];
                $pendingPct = $totalStats > 0 ? round(($stats['tertunda'] / ($stats['berjalan'] + $stats['tertunda'] + ($stats['tertunda'] == 0 ? 1 : 0))) * 100) : 0;
            @endphp
            <div class="mt-4 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between text-xs mb-1.5">
                    <span class="text-slate-500">Rasio pending vs aktif</span>
                    <span class="font-semibold text-slate-700">{{ $stats['tertunda'] }}/{{ max($stats['berjalan'], 1) }}</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-1.5">
                    <div class="bg-amber-400 h-1.5 rounded-full" style="width: {{ min($pendingPct, 100) }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 block w-full pl-10 p-2.5 transition-all" placeholder="Cari nama proker atau ormawa...">
                @if($search)
                    <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                @endif
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-xs font-medium text-slate-500 mr-1">Status:</span>
                <button wire:click="setStatus('')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === '' ? 'bg-navy-800 border-navy-800 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300' }}">
                    Semua
                </button>
                <button wire:click="setStatus('berjalan')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === 'berjalan' ? 'bg-primary-600 border-primary-600 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300' }}">
                    Sedang Berjalan
                </button>
                <button wire:click="setStatus('selesai')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === 'selesai' ? 'bg-success-600 border-success-600 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300' }}">
                    Selesai
                </button>
                <button wire:click="setStatus('belum_dimulai')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === 'belum_dimulai' ? 'bg-amber-500 border-amber-500 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300' }}">
                    Belum Dimulai
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-[30%]">Nama Program</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Ormawa</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-56">Progress</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($prokers as $proker)
                        @php
                            $colors = match($proker->status) {
                                'selesai' => ['dot' => 'bg-success-500', 'badge' => 'bg-success-50 text-success-700', 'bar' => 'bg-success-500', 'track' => 'bg-success-100'],
                                'berjalan' => ['dot' => 'bg-primary-500', 'badge' => 'bg-primary-50 text-primary-700', 'bar' => 'bg-primary-600', 'track' => 'bg-primary-100'],
                                default => ['dot' => 'bg-slate-400', 'badge' => 'bg-slate-100 text-slate-600', 'bar' => 'bg-slate-400', 'track' => 'bg-slate-100'],
                            };
                            $label = match($proker->status) {
                                'selesai' => 'Selesai',
                                'berjalan' => 'Berjalan',
                                default => 'Belum Dimulai',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="px-6 py-4.5">
                                <p class="font-semibold text-navy-800">{{ $proker->nama_proker }}</p>
                                <p class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M Y') }}
                                </p>
                            </td>
                            <td class="px-6 py-4.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-[10px] font-bold shrink-0">
                                        {{ substr($proker->ormawa->nama ?? '?', 0, 1) }}
                                    </div>
                                    <span class="font-medium text-slate-700">{{ $proker->ormawa->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4.5 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-bold rounded-lg {{ $colors['badge'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['dot'] }}"></span>
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="px-6 py-4.5">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 bg-slate-100 rounded-full h-2 overflow-hidden">
                                        <div class="{{ $colors['bar'] }} h-2 rounded-full transition-all duration-500" style="width: {{ $proker->progress }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-navy-700 min-w-[2.5rem] text-right tabular-nums">{{ $proker->progress }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4.5 text-right">
                                <a href="{{ route('admin.proker.detail', $proker->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-50 hover:bg-primary-50 text-slate-600 hover:text-primary-600 text-xs font-semibold rounded-xl border border-slate-200 hover:border-primary-200 transition-all duration-150">
                                    Detail
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="max-w-xs mx-auto">
                                    <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    </div>
                                    <h4 class="text-base font-semibold text-navy-800 mb-1">Belum ada data program kerja</h4>
                                    <p class="text-sm text-slate-400 leading-relaxed">Program kerja dari setiap ormawa akan muncul di sini setelah didaftarkan melalui dashboard ormawa masing-masing.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($prokers->hasPages())
        <div class="flex items-center justify-between">
            <p class="text-sm text-slate-500">
                Menampilkan {{ $prokers->firstItem() }}-{{ $prokers->lastItem() }} dari {{ $prokers->total() }} program
            </p>
            <div class="flex items-center gap-1.5">
                @if($prokers->onFirstPage())
                    <span class="px-3 py-1.5 text-xs font-medium text-slate-400 bg-slate-50 rounded-lg border border-slate-200 cursor-default">Sebelumnya</span>
                @else
                    <button wire:click="previousPage" class="px-3 py-1.5 text-xs font-medium text-slate-600 bg-white rounded-lg border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all">Sebelumnya</button>
                @endif
                @foreach($prokers->getUrlRange(max(1, $prokers->currentPage() - 2), min($prokers->lastPage(), $prokers->currentPage() + 2)) as $page => $url)
                    <button wire:click="gotoPage({{ $page }})" class="px-3 py-1.5 text-xs font-semibold rounded-lg border transition-all {{ $page === $prokers->currentPage() ? 'bg-navy-800 border-navy-800 text-white shadow-sm' : 'text-slate-600 bg-white border-slate-200 hover:bg-slate-50' }}">{{ $page }}</button>
                @endforeach
                @if($prokers->hasMorePages())
                    <button wire:click="nextPage" class="px-3 py-1.5 text-xs font-medium text-slate-600 bg-white rounded-lg border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all">Selanjutnya</button>
                @else
                    <span class="px-3 py-1.5 text-xs font-medium text-slate-400 bg-slate-50 rounded-lg border border-slate-200 cursor-default">Selanjutnya</span>
                @endif
            </div>
        </div>
    @endif
</div>
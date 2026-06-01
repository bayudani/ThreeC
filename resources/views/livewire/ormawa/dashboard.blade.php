<div class="max-w-7xl mx-auto space-y-6">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-800">Dashboard {{ Auth::user()->ormawa->nama ?? 'Ormawa' }}</h2>
        <p class="text-sm text-slate-500 mt-0.5">Pantau program kerja dan progres ormawa Anda</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Proker</p>
            <p class="text-3xl font-bold text-indigo-700 mt-2">{{ $totalProker }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $selesai }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sedang Berjalan</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $berjalan }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Dimulai</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $belumDimulai }}</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider opacity-80">Tingkat Keberhasilan</p>
                <p class="text-5xl font-extrabold mt-1">{{ $successRate }}%</p>
                <p class="text-sm mt-1 text-blue-100">Proker selesai dari total keseluruhan</p>
            </div>
            <div class="w-24 h-24 rounded-full border-4 border-white/30 flex items-center justify-center">
                <span class="text-3xl font-extrabold">{{ $successRate }}%</span>
            </div>
        </div>
        <div class="mt-4 w-full bg-white/20 rounded-full h-2">
            <div class="bg-white h-2 rounded-full" style="width: {{ $successRate }}%"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800">Program Kerja Terbaru</h3>
                <a href="{{ route('ormawa.proker') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800">Lihat semua</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($prokerTerbaru as $p)
                <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ $p->nama_proker }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            Target: {{ \Carbon\Carbon::parse($p->target_waktu)->isoFormat('D MMM Y') }}
                            &middot; {{ $p->dokumentasis_count }} dokumen
                        </p>
                    </div>
                    <div class="ml-3 flex items-center gap-2">
                        <div class="flex items-center gap-1.5">
                            <div class="w-16 bg-slate-100 rounded-full h-1.5">
                                <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $p->progress }}%"></div>
                            </div>
                            <span class="text-xs font-bold text-slate-600 w-8 text-right">{{ $p->progress }}%</span>
                        </div>
                        <span class="px-2 py-0.5 text-[10px] font-bold rounded
                            {{ $p->status === 'selesai' ? 'bg-green-50 text-green-700' : ($p->status === 'berjalan' ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-500') }}">
                            {{ str_replace('_', ' ', ucwords($p->status)) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-sm text-slate-400">Belum ada program kerja.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="p-5 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-800">Aktivitas Terbaru</h3>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($aktivitas as $a)
                <div class="p-4 flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 text-xs font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-700 leading-snug">
                            Dokumen diunggah untuk "<span class="font-semibold">{{ $a['proker'] }}</span>"
                        </p>
                        @if($a['keterangan'])
                        <p class="text-xs text-slate-400 mt-0.5 italic">&ldquo;{{ $a['keterangan'] }}&rdquo;</p>
                        @endif
                        <p class="text-xs text-slate-400 mt-0.5">{{ $a['waktu']->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-sm text-slate-400">Belum ada aktivitas.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

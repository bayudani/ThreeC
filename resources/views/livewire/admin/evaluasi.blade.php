<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-extrabold text-slate-800">Evaluasi &amp; Monev Ormawa</h2>
        <div class="flex items-center gap-2">
            <span class="text-xs font-medium text-slate-500">Periode:</span>
            <div class="flex gap-1 flex-wrap">
                <button wire:click="filterByPeriode('')"
                    class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors
                    {{ $periode === '' ? 'bg-blue-600 text-white shadow' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                    Semua
                </button>
                @foreach($periodeList as $p)
                <button wire:click="filterByPeriode('{{ $p }}')"
                    class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors
                    {{ $periode === $p ? 'bg-blue-600 text-white shadow' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                    {{ $p }}
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Ormawa</p>
            <p class="text-3xl font-bold text-blue-700 mt-2">{{ $totalOrmawa }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Proker</p>
            <p class="text-3xl font-bold text-indigo-700 mt-2">{{ $totalProker }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalSelesai }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Berjalan</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalBerjalan }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Dimulai</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalBelum }}</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider opacity-80">Tingkat Keberhasilan</p>
                <p class="text-5xl font-extrabold mt-1">{{ $successRate }}%</p>
                <p class="text-sm mt-1 text-blue-100">Proker selesai dari total keseluruhan</p>
            </div>
            <div class="hidden sm:block">
                <div class="w-24 h-24 rounded-full border-4 border-white/30 flex items-center justify-center">
                    <span class="text-3xl font-extrabold">{{ $successRate }}%</span>
                </div>
            </div>
        </div>
        <div class="mt-4 w-full bg-white/20 rounded-full h-2">
            <div class="bg-white h-2 rounded-full transition-all" style="width: {{ $successRate }}%"></div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Rekap Evaluasi Ormawa</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.laporan.export', ['periode' => $periode, 'format' => 'pdf']) }}"
                    class="px-3 py-1.5 text-xs font-semibold bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    PDF
                </a>
                <a href="{{ route('admin.laporan.export', ['periode' => $periode, 'format' => 'csv']) }}"
                    class="px-3 py-1.5 text-xs font-semibold bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    CSV
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="text-left px-4 py-3">No</th>
                        <th class="text-left px-4 py-3">Ormawa</th>
                        <th class="text-left px-4 py-3">Kategori</th>
                        <th class="text-left px-4 py-3">Fakultas</th>
                        <th class="text-center px-4 py-3">Total</th>
                        <th class="text-center px-4 py-3">Selesai</th>
                        <th class="text-center px-4 py-3">Berjalan</th>
                        <th class="text-center px-4 py-3">Belum</th>
                        <th class="text-center px-4 py-3">Progress</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($ormawas as $i => $o)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-3 text-slate-400">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 font-semibold text-slate-800">{{ $o->nama }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded
                                {{ match($o->kategori) { 'Legislatif' => 'bg-purple-50 text-purple-700', 'Eksekutif' => 'bg-blue-50 text-blue-700', 'UKM' => 'bg-amber-50 text-amber-700', default => 'bg-slate-50 text-slate-700' } }}">
                                {{ $o->kategori }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $o->fakultas ?? '-' }}</td>
                        <td class="px-4 py-3 text-center font-bold text-slate-700">{{ $o->total_proker }}</td>
                        <td class="px-4 py-3 text-center font-semibold text-green-600">{{ $o->proker_selesai }}</td>
                        <td class="px-4 py-3 text-center font-semibold text-blue-600">{{ $o->proker_berjalan }}</td>
                        <td class="px-4 py-3 text-center font-semibold text-slate-400">{{ $o->proker_belum }}</td>
                        <td class="px-4 py-3 text-center">
                            @php $pct = $o->total_proker > 0 ? round(($o->proker_selesai / $o->total_proker) * 100) : 0; @endphp
                            <div class="flex items-center gap-2 justify-center">
                                <div class="w-16 bg-slate-100 rounded-full h-1.5">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="text-xs font-bold {{ $pct >= 80 ? 'text-green-600' : ($pct >= 50 ? 'text-amber-600' : 'text-red-600') }}">
                                    {{ $pct }}%
                                </span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center px-4 py-10 text-slate-400">Belum ada data ormawa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

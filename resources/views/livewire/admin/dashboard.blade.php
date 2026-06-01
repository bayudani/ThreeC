<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-extrabold text-slate-800">Dashboard Monitoring</h2>
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
            <div class="w-px h-6 bg-slate-200 mx-1"></div>
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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Ormawa</p>
                <div class="w-8 h-8 rounded-md bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-blue-700 mt-2">{{ $totalOrmawa }}</p>
        </div>

        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Proker</p>
                <div class="w-8 h-8 rounded-md bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-indigo-700 mt-2">{{ $totalProker }}</p>
        </div>

        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
                <span class="px-2 py-1 bg-green-50 text-green-700 text-[10px] font-bold rounded">DONE</span>
            </div>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $selesai }}</p>
        </div>

        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sedang Berjalan</p>
                <span class="px-2 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold rounded">AKTIF</span>
            </div>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $berjalan }}</p>
        </div>

        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Dimulai</p>
                <span class="px-2 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded">PENDING</span>
            </div>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $belumDimulai }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-slate-800">Monitoring Program Kerja</h3>
                    <span class="text-xs text-slate-400">Per kategori ormawa</span>
                </div>

                @if(count($chartCategories) > 0)
                    @php
                        $maxData = max($chartData);
                    @endphp
                    <div class="space-y-4">
                        @foreach($chartCategories as $i => $cat)
                            @php
                                $count = $chartData[$i];
                                $pct = $maxData > 0 ? ($count / $maxData) * 100 : 0;
                                $colors = ['BEM' => 'bg-blue-500', 'DPM' => 'bg-indigo-500', 'HIMA' => 'bg-emerald-500', 'UKM' => 'bg-amber-500', 'MPM' => 'bg-purple-500'];
                                $barColor = $colors[$cat] ?? 'bg-slate-500';
                            @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-1.5">
                                    <span class="font-medium text-slate-700">{{ $cat }}</span>
                                    <span class="font-bold text-slate-800">{{ $count }} proker</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-3">
                                    <div class="{{ $barColor }} h-3 rounded-full transition-all" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-400 text-center py-8">Belum ada data proker.</p>
                @endif
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-slate-800">Status Proker</h3>
                    <span class="text-xs text-slate-400">Ringkasan keseluruhan</span>
                </div>

                @php
                    $total = max($totalProker, 1);
                    $pctSelesai = round(($selesai / $total) * 100);
                    $pctBerjalan = round(($berjalan / $total) * 100);
                    $pctBelum = round(($belumDimulai / $total) * 100);
                @endphp

                <div class="flex items-end gap-1 h-40 mb-2">
                    @foreach([
                        ['label' => 'Selesai', 'count' => $selesai, 'pct' => $pctSelesai, 'color' => 'bg-green-500'],
                        ['label' => 'Berjalan', 'count' => $berjalan, 'pct' => $pctBerjalan, 'color' => 'bg-blue-500'],
                        ['label' => 'Belum Dimulai', 'count' => $belumDimulai, 'pct' => $pctBelum, 'color' => 'bg-slate-400'],
                    ] as $bar)
                        <div class="flex-1 flex flex-col items-center gap-2">
                            <span class="text-xs font-bold text-slate-700">{{ $bar['count'] }}</span>
                            <div class="w-full max-w-[60px] bg-slate-100 rounded-md relative" style="height: 120px;">
                                <div class="absolute bottom-0 w-full {{ $bar['color'] }} rounded-md transition-all" style="height: {{ $bar['pct'] }}%"></div>
                            </div>
                            <span class="text-xs text-slate-500 text-center">{{ $bar['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 bg-gradient-to-br from-blue-600 to-indigo-700 text-white relative overflow-hidden">
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-white rounded-full opacity-10 blur-2xl"></div>
                <p class="text-xs font-bold uppercase tracking-wider opacity-80">Tingkat Keberhasilan</p>
                <p class="text-5xl font-extrabold mt-2">{{ $successRate }}%</p>
                <p class="text-sm mt-1 text-blue-100">Proker selesai dari total keseluruhan</p>
                <div class="mt-4 w-full bg-white/20 rounded-full h-1.5">
                    <div class="bg-white h-1.5 rounded-full" style="width: {{ $successRate }}%"></div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <div class="p-5 border-b border-slate-100">
                    <h3 class="text-sm font-bold text-slate-800">Update Terbaru</h3>
                </div>
                <div class="flex-1 divide-y divide-slate-100">
                    @forelse($aktivitas as $item)
                        <div class="p-4 flex gap-3 hover:bg-slate-50 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 text-xs font-bold">
                                {{ substr($item['ormawa'], 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-700 leading-snug">
                                    <span class="font-bold">{{ $item['ormawa'] }}</span>
                                    {{ $item['tipe'] === 'Dokumen' ? 'mengunggah dokumen' : 'menambahkan proker' }}
                                    "{{ $item['proker'] }}"
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $item['waktu']->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-sm text-slate-400">Belum ada aktivitas.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

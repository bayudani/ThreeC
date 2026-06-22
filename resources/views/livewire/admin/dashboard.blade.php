<div class="max-w-7xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-9 h-9 bg-blue-600/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Dashboard Monitoring</h2>
                    <p class="text-sm text-slate-500">Overview aktivitas organisasi mahasiswa</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <select wire:model.live="periode"
                    class="appearance-none bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-lg pl-3 pr-8 py-2 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 cursor-pointer">
                    <option value="">Semua Periode</option>
                    @foreach($periodeList as $p)
                        <option value="{{ $p }}">{{ $p }}</option>
                    @endforeach
                </select>
                <svg class="absolute right-2.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <div class="w-px h-6 bg-slate-200"></div>
            <a href="{{ route('admin.laporan.export', ['periode' => $periode, 'format' => 'pdf']) }}"
                class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                PDF
            </a>
            <a href="{{ route('admin.laporan.export', ['periode' => $periode, 'format' => 'csv']) }}"
                class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                CSV
            </a>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-blue-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-[11px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">Total</span>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Ormawa</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalOrmawa }}</p>
        </div>

        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <span class="text-[11px] font-semibold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">Total</span>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Program Kerja</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalProker }}</p>
        </div>

        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Done</span>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
            <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $selesai }}</p>
        </div>

        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-blue-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-[11px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">Aktif</span>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Berjalan</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $berjalan }}</p>
        </div>

        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-slate-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative flex items-start justify-between mb-3">
                <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[11px] font-semibold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">Pending</span>
            </div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Dimulai</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ $belumDimulai }}</p>
        </div>
    </div>

    {{-- Charts & Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column (2/3) --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Bar Chart: Proker per Kategori --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Monitoring Program Kerja</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Distribusi proker per kategori ormawa</p>
                    </div>
                </div>

                @if(count($chartCategories) > 0)
                    @php
                        $maxData = max($chartData);
                        $chartColors = ['Legislatif' => ['bar' => 'from-amber-500 to-amber-400', 'bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'dot' => 'bg-amber-500'], 'Eksekutif' => ['bar' => 'from-blue-500 to-blue-400', 'bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500'], 'UKM' => ['bar' => 'from-violet-500 to-violet-400', 'bg' => 'bg-violet-50', 'text' => 'text-violet-700', 'dot' => 'bg-violet-500']];
                    @endphp
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        @foreach($chartCategories as $i => $cat)
                            @php $cc = $chartColors[$cat] ?? ['bar' => 'from-slate-500 to-slate-400', 'bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'dot' => 'bg-slate-500']; @endphp
                            <div class="p-4 rounded-xl {{ $cc['bg'] }} border border-slate-100">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="w-2 h-2 rounded-full {{ $cc['dot'] }}"></span>
                                    <span class="text-sm font-semibold {{ $cc['text'] }}">{{ $cat }}</span>
                                </div>
                                <p class="text-2xl font-bold text-slate-800 mt-1">{{ $chartData[$i] }}</p>
                                <p class="text-xs text-slate-500">program kerja</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-4">
                        @foreach($chartCategories as $i => $cat)
                            @php
                                $count = $chartData[$i];
                                $pct = $maxData > 0 ? ($count / $maxData) * 100 : 0;
                                $cc = $chartColors[$cat] ?? ['bar' => 'from-slate-500 to-slate-400', 'bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'dot' => 'bg-slate-500'];
                            @endphp
                            <div>
                                <div class="flex justify-between items-center mb-1.5">
                                    <span class="text-sm font-semibold text-slate-700">{{ $cat }}</span>
                                    <span class="text-sm font-bold text-slate-800">{{ $count }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                    <div class="h-full rounded-full bg-gradient-to-r {{ $cc['bar'] }} transition-all duration-500" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 text-slate-400">
                        <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <p class="text-sm font-medium">Belum ada data proker</p>
                    </div>
                @endif
            </div>

            {{-- Proker Status --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Status Program Kerja</h3>
                        <p class="text-sm text-slate-500 mt-0.5">Ringkasan status keseluruhan</p>
                    </div>
                </div>

                @php
                    $total = max($totalProker, 1);
                    $statusBars = [
                        ['label' => 'Selesai', 'count' => $selesai, 'pct' => round(($selesai / $total) * 100), 'color' => 'bg-emerald-500', 'barColor' => 'from-emerald-500 to-emerald-400', 'light' => 'bg-emerald-50'],
                        ['label' => 'Berjalan', 'count' => $berjalan, 'pct' => round(($berjalan / $total) * 100), 'color' => 'bg-blue-500', 'barColor' => 'from-blue-500 to-blue-400', 'light' => 'bg-blue-50'],
                        ['label' => 'Belum Dimulai', 'count' => $belumDimulai, 'pct' => round(($belumDimulai / $total) * 100), 'color' => 'bg-slate-400', 'barColor' => 'from-slate-400 to-slate-300', 'light' => 'bg-slate-50'],
                    ];
                @endphp

                <div class="flex items-end gap-6 h-48 mb-6">
                    @foreach($statusBars as $bar)
                        <div class="flex-1 flex flex-col items-center gap-3 h-full justify-end">
                            <span class="text-lg font-bold text-slate-800">{{ $bar['count'] }}</span>
                            <div class="w-full max-w-[72px] {{ $bar['light'] }} rounded-xl relative overflow-hidden" style="height: 70%;">
                                <div class="absolute bottom-0 w-full bg-gradient-to-t {{ $bar['barColor'] }} rounded-xl transition-all duration-500" style="height: {{ $bar['pct'] }}%"></div>
                            </div>
                            <span class="text-xs font-semibold text-slate-500 text-center">{{ $bar['label'] }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-center gap-6 pt-4 border-t border-slate-100">
                    @foreach($statusBars as $bar)
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $bar['color'] }}"></span>
                            <span class="text-xs text-slate-600">{{ $bar['label'] }} ({{ $bar['pct'] }}%)</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right Column (1/3) --}}
        <div class="space-y-6">
            {{-- Success Rate Card --}}
            <div class="rounded-xl border border-slate-200 shadow-sm p-6 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/5 rounded-full"></div>
                <div class="absolute -left-8 bottom-8 w-32 h-32 bg-white/[0.03] rounded-full"></div>

                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-blue-100/80">Tingkat Keberhasilan</p>
                        <div class="w-9 h-9 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <div class="flex items-end gap-4 mb-4">
                        <p class="text-5xl font-extrabold tracking-tight">{{ $successRate }}<span class="text-2xl text-blue-200">%</span></p>
                    </div>

                    @php
                        $rateColor = $successRate >= 75 ? 'bg-emerald-400' : ($successRate >= 50 ? 'bg-amber-400' : 'bg-red-400');
                    @endphp
                    <div class="w-full bg-white/15 rounded-full h-2 mb-2 overflow-hidden">
                        <div class="h-full rounded-full {{ $rateColor }} transition-all duration-700" style="width: {{ $successRate }}%"></div>
                    </div>
                    <p class="text-sm text-blue-100/80">Proker selesai dari total keseluruhan</p>

                    <div class="grid grid-cols-2 gap-3 mt-5 pt-5 border-t border-white/10">
                        <div>
                            <p class="text-xs text-blue-200/70">Selesai</p>
                            <p class="text-lg font-bold">{{ $selesai }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-blue-200/70">Total Proker</p>
                            <p class="text-lg font-bold">{{ $totalProker }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Activity Feed --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <div class="px-5 py-4 border-b border-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800">Update Terbaru</h3>
                        </div>
                        <span class="text-[11px] text-slate-400 font-medium">{{ $aktivitas->count() }} aktivitas</span>
                    </div>
                </div>
                <div class="flex-1 divide-y divide-slate-100">
                    @forelse($aktivitas as $item)
                        <div class="p-4 flex gap-3 hover:bg-slate-50 transition-colors">
                            <div class="relative">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br {{ $item['tipe'] === 'Dokumen' ? 'from-amber-400 to-amber-500' : 'from-blue-400 to-blue-500' }} flex items-center justify-center shrink-0 text-white text-xs font-bold shadow-sm">
                                    {{ substr($item['ormawa'], 0, 1) }}
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs text-slate-700 leading-relaxed">
                                    <span class="font-bold text-slate-800">{{ $item['ormawa'] }}</span>
                                    <span class="text-slate-500"> {{ $item['tipe'] === 'Dokumen' ? 'mengunggah dokumen' : 'menambahkan proker' }} </span>
                                    <span class="font-semibold text-slate-700">"{{ \Illuminate\Support\Str::limit($item['proker'], 30) }}"</span>
                                </p>
                                <p class="text-xs text-slate-400 mt-1">{{ $item['waktu']->diffForHumans() }}</p>
                            </div>
                            <div class="shrink-0">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $item['tipe'] === 'Dokumen' ? 'bg-amber-50 text-amber-700' : 'bg-blue-50 text-blue-700' }}">
                                    {{ $item['tipe'] === 'Dokumen' ? 'Dok' : 'Proker' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-8 text-slate-400">
                            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-sm font-medium">Belum ada aktivitas</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
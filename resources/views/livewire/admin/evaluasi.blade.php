<div class="max-w-7xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-9 h-9 bg-emerald-600/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Evaluasi &amp; Monev</h2>
                    <p class="text-sm text-slate-500">Pantau dan evaluasi kinerja program kerja ormawa</p>
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
            <div class="relative">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Ormawa</p>
                <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalOrmawa }}</p>
            </div>
        </div>
        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Proker</p>
                <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalProker }}</p>
            </div>
        </div>
        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
                <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $totalSelesai }}</p>
            </div>
        </div>
        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-blue-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Berjalan</p>
                <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalBerjalan }}</p>
            </div>
        </div>
        <div class="group bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 bg-slate-500/[0.04] rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Dimulai</p>
                <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalBelum }}</p>
            </div>
        </div>
    </div>

    {{-- Success Rate Hero --}}
    <div class="rounded-xl border border-slate-200 shadow-sm p-6 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white relative overflow-hidden">
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/5 rounded-full"></div>
        <div class="absolute -left-8 bottom-8 w-32 h-32 bg-white/[0.03] rounded-full"></div>
        <div class="relative flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-blue-100/80">Tingkat Keberhasilan</p>
                <div class="flex items-end gap-3 mt-1">
                    <p class="text-5xl font-extrabold tracking-tight">{{ $successRate }}<span class="text-2xl text-blue-200">%</span></p>
                    <div class="flex items-center gap-1.5 text-sm text-blue-100/80 mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span>{{ $totalSelesai }}/{{ $totalProker }} proker selesai</span>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="w-24 h-24 rounded-full border-4 border-white/25 flex items-center justify-center">
                    <span class="text-3xl font-extrabold">{{ $successRate }}%</span>
                </div>
            </div>
        </div>
        @php $rateColor = $successRate >= 75 ? 'bg-blue-300' : ($successRate >= 50 ? 'bg-amber-300' : 'bg-red-300'); @endphp
        <div class="relative mt-5 w-full bg-white/15 rounded-full h-2.5 overflow-hidden">
            <div class="h-full rounded-full {{ $rateColor }} transition-all duration-700" style="width: {{ $successRate }}%"></div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        {{-- Toolbar --}}
        <div class="p-5 border-b border-slate-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
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
                <div class="relative w-full md:w-64">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text"
                        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full pl-9 p-2.5 placeholder:text-slate-400"
                        placeholder="Cari nama ormawa...">
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-5 py-4 font-semibold tracking-wider">No</th>
                        <th scope="col" class="px-5 py-4 font-semibold tracking-wider">Ormawa</th>
                        <th scope="col" class="px-5 py-4 font-semibold tracking-wider">Kategori</th>
                        <th scope="col" class="px-5 py-4 font-semibold tracking-wider">Fakultas</th>
                        <th scope="col" class="px-5 py-4 text-center font-semibold tracking-wider">Total</th>
                        <th scope="col" class="px-5 py-4 text-center font-semibold tracking-wider">Selesai</th>
                        <th scope="col" class="px-5 py-4 text-center font-semibold tracking-wider">Berjalan</th>
                        <th scope="col" class="px-5 py-4 text-center font-semibold tracking-wider">Belum</th>
                        <th scope="col" class="px-5 py-4 text-center font-semibold tracking-wider">Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ormawas as $i => $o)
                        <tr class="bg-white border-b border-slate-100 hover:bg-blue-50/20 transition-colors">
                            <td class="px-5 py-4 text-slate-400">{{ $ormawas->firstItem() + $i }}</td>
                            <td class="px-5 py-4 font-semibold text-slate-800">{{ $o->nama }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full {{ $o->kategori === 'Legislatif' ? 'bg-amber-50 text-amber-700 border border-amber-200' : ($o->kategori === 'Eksekutif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-violet-50 text-violet-700 border border-violet-200') }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $o->kategori === 'Legislatif' ? 'bg-amber-500' : ($o->kategori === 'Eksekutif' ? 'bg-emerald-500' : 'bg-violet-500') }}"></span>
                                    {{ $o->kategori }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $o->fakultas ?? '-' }}</td>
                            <td class="px-5 py-4 text-center font-bold text-slate-700">{{ $o->total_proker }}</td>
                            <td class="px-5 py-4 text-center font-semibold text-emerald-600">{{ $o->proker_selesai }}</td>
                            <td class="px-5 py-4 text-center font-semibold text-blue-600">{{ $o->proker_berjalan }}</td>
                            <td class="px-5 py-4 text-center font-semibold text-slate-400">{{ $o->proker_belum }}</td>
                            <td class="px-5 py-4 text-center">
                                @php $pct = $o->total_proker > 0 ? round(($o->proker_selesai / $o->total_proker) * 100) : 0; @endphp
                                <div class="flex items-center gap-2.5 justify-center min-w-[100px]">
                                    <div class="flex-1 max-w-[64px] bg-slate-100 rounded-full h-2 overflow-hidden">
                                        <div class="h-full rounded-full {{ $pct >= 80 ? 'bg-emerald-500' : ($pct >= 50 ? 'bg-amber-500' : 'bg-red-500') }}" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold min-w-[32px] {{ $pct >= 80 ? 'text-emerald-600' : ($pct >= 50 ? 'text-amber-600' : 'text-red-600') }}">
                                        {{ $pct }}%
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                        <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    </div>
                                    <p class="text-base font-semibold text-slate-600">Belum ada data evaluasi</p>
                                    <p class="text-sm text-slate-400 mt-1">Data ormawa akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="pt-2">
        {{ $ormawas->links(data: ['scrollTo' => false]) }}
    </div>
</div>
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Program Kerja</h2>
            <p class="text-sm text-slate-500">Pemantauan inisiatif strategis dan kegiatan seluruh ormawa.</p>
        </div>
        <button class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export Laporan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Big Purple Success Rate Card -->
        <div class="md:col-span-1 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl p-6 text-white shadow-md relative overflow-hidden flex flex-col justify-between h-44">
            <div class="absolute -right-8 -top-8 w-32 h-32 bg-white rounded-full opacity-10 blur-2xl"></div>
            <div>
                <span class="px-2.5 py-1 bg-white/20 text-white text-[10px] font-bold tracking-wider rounded uppercase">Performa Kuartal Ini</span>
            </div>
            <div>
                <div class="text-5xl font-extrabold tracking-tight">{{ $stats['successRate'] }}%</div>
                <h3 class="text-lg font-semibold mt-1">Tingkat Keberhasilan</h3>
                <p class="text-blue-100 text-xs mt-1 opacity-80 line-clamp-1">Proker yang memenuhi target kampus (selesai).</p>
            </div>
        </div>

        <!-- Metric 2: Active Programs -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col justify-center h-44 shadow-sm relative">
            <div class="absolute top-6 right-6 text-green-500 font-bold text-sm bg-green-50 px-2 py-1 rounded">Aktif</div>
            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Proker Berjalan</p>
            <h3 class="text-4xl font-extrabold text-slate-800 mt-1">{{ $stats['berjalan'] }}</h3>
        </div>

        <!-- Metric 3: Pending/Delayed -->
        <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col justify-center h-44 shadow-sm relative">
            <div class="absolute top-6 right-6 text-red-500 font-bold text-sm bg-red-50 px-2 py-1 rounded">Perhatian</div>
            <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Belum Dimulai / Tertunda</p>
            <h3 class="text-4xl font-extrabold text-slate-800 mt-1">{{ $stats['tertunda'] }}</h3>
        </div>
    </div>

    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-9 p-2.5" placeholder="Cari nama proker atau ormawa...">
        </div>
        
        <div class="flex gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
            <button wire:click="setStatus('')" class="px-4 py-2 text-sm font-medium rounded-lg border whitespace-nowrap transition-colors {{ $filterStatus === '' ? 'bg-slate-800 border-slate-800 text-white' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                Semua Status
            </button>
            <button wire:click="setStatus('berjalan')" class="px-4 py-2 text-sm font-medium rounded-lg border whitespace-nowrap transition-colors {{ $filterStatus === 'berjalan' ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                Sedang Berjalan
            </button>
            <button wire:click="setStatus('selesai')" class="px-4 py-2 text-sm font-medium rounded-lg border whitespace-nowrap transition-colors {{ $filterStatus === 'selesai' ? 'bg-green-600 border-green-600 text-white' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                Selesai
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold w-2/5">Nama Program</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Ormawa</th>
                        <th scope="col" class="px-6 py-4 font-semibold text-center">Status</th>
                        <th scope="col" class="px-6 py-4 font-semibold w-48">Progress</th>
                        <th scope="col" class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prokers as $proker)
                        @php
                            // Tentukan warna border dan badge berdasarkan status
                            $statusColor = match($proker->status) {
                                'selesai' => ['border' => 'border-l-green-500', 'badge' => 'bg-green-100 text-green-700', 'bar' => 'bg-green-500'],
                                'berjalan' => ['border' => 'border-l-blue-500', 'badge' => 'bg-blue-100 text-blue-700', 'bar' => 'bg-blue-600'],
                                default => ['border' => 'border-l-slate-300', 'badge' => 'bg-slate-100 text-slate-600', 'bar' => 'bg-slate-400'],
                            };
                            
                            $statusText = match($proker->status) {
                                'selesai' => 'Selesai',
                                'berjalan' => 'Berjalan',
                                default => 'Belum Dimulai',
                            };
                        @endphp
                        <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors border-l-4 {{ $statusColor['border'] }}">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">{{ $proker->nama_proker }}</p>
                                <p class="text-xs text-slate-500 mt-1">Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $proker->ormawa->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-[11px] font-bold rounded-full {{ $statusColor['badge'] }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-full bg-slate-100 rounded-full h-2">
                                        <div class="{{ $statusColor['bar'] }} h-2 rounded-full" style="width: {{ $proker->progress }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700 min-w-[2rem] text-right">{{ $proker->progress }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.proker.detail', $proker->id) }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <p class="text-slate-500 font-medium">Belum ada data program kerja.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $prokers->links(data: ['scrollTo' => false]) }}
    </div>

</div>
<div class="max-w-6xl mx-auto space-y-6">
    {{-- Back Button --}}
    <a href="{{ route('admin.proker') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Kembali ke Program Kerja
    </a>

    {{-- Hero Header --}}
    @php
        $statusColors = match($proker->status) {
            'selesai' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500', 'badge' => 'bg-emerald-100 text-emerald-700'],
            'berjalan' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500', 'badge' => 'bg-blue-100 text-blue-700'],
            default => ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400', 'badge' => 'bg-slate-100 text-slate-600'],
        };
        $statusText = match($proker->status) {
            'selesai' => 'Selesai',
            'berjalan' => 'Sedang Berjalan',
            default => 'Belum Dimulai',
        };
    @endphp

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/5 via-transparent to-transparent"></div>
            <div class="relative p-8">
                <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-lg {{ $statusColors['badge'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusColors['dot'] }}"></span>
                                {{ $statusText }}
                            </span>
                            <span class="text-xs text-slate-400 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-slate-900 tracking-tight">{{ $proker->nama_proker }}</h1>
                    </div>

                    <div class="flex items-center gap-4 shrink-0">
                        <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 rounded-xl border border-slate-200">
                            @if($proker->ormawa->logo)
                                <img src="{{ $proker->ormawa->logoUrl() }}" alt="{{ $proker->ormawa->nama }}" class="w-10 h-10 object-contain rounded-lg">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                                    {{ substr($proker->ormawa->nama, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <p class="text-xs text-slate-400">Ormawa</p>
                                <p class="text-sm font-bold text-slate-800">{{ $proker->ormawa->nama }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($proker->deskripsi)
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $proker->deskripsi }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Progress & Documentation --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Progress Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Progress</h3>
                    <span class="text-2xl font-bold {{ $proker->progress >= 100 ? 'text-emerald-600' : ($proker->progress >= 50 ? 'text-blue-600' : 'text-slate-500') }}">{{ $proker->progress }}%</span>
                </div>

                <div class="space-y-2 mb-6">
                    <div class="w-full bg-slate-100 rounded-full h-3.5 overflow-hidden">
                        <div class="h-3.5 rounded-full transition-all duration-700 ease-out {{ $proker->progress >= 100 ? 'bg-emerald-500' : ($proker->progress >= 50 ? 'bg-blue-500' : 'bg-slate-400') }}" style="width: {{ $proker->progress }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-slate-400">
                        <span>0%</span>
                        <span>50%</span>
                        <span>100%</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-slate-500 font-medium">Target</p>
                        <p class="text-sm font-bold text-slate-800 mt-1">{{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-slate-500 font-medium">Dibuat</p>
                        <p class="text-sm font-bold text-slate-800 mt-1">{{ $proker->created_at->translatedFormat('d M') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-slate-500 font-medium">Diperbarui</p>
                        <p class="text-sm font-bold text-slate-800 mt-1">{{ $proker->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            {{-- Timeline Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-6">Tahapan</h3>

                @php
                    $steps = [
                        ['label' => 'Perencanaan', 'desc' => 'Menyusun konsep dan rencana kegiatan', 'done' => true],
                        ['label' => 'Persiapan', 'desc' => 'Mempersiapkan kebutuhan dan perlengkapan', 'done' => $proker->status !== 'belum_dimulai'],
                        ['label' => 'Pelaksanaan', 'desc' => 'Menjalankan kegiatan sesuai rencana', 'done' => $proker->status === 'berjalan' || $proker->status === 'selesai'],
                        ['label' => 'Evaluasi & Laporan', 'desc' => 'Menyusun laporan dan evaluasi akhir', 'done' => $proker->status === 'selesai'],
                    ];
                @endphp

                <div class="space-y-0">
                    @foreach($steps as $i => $step)
                        <div class="flex items-start gap-4 pb-8 relative last:pb-0">
                            @if(!$loop->last)
                                <div class="absolute left-[17px] top-9 bottom-0 w-0.5 {{ ($steps[$i+1]['done'] ?? false) ? 'bg-blue-500' : 'bg-slate-200' }}"></div>
                            @endif

                            <div class="w-[34px] h-[34px] rounded-full flex items-center justify-center shrink-0 z-10 {{ $step['done'] ? 'bg-blue-600 text-white shadow-sm shadow-blue-200' : 'bg-slate-100 text-slate-400' }}">
                                @if($step['done'])
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                @else
                                    <span class="text-xs font-bold">{{ $i + 1 }}</span>
                                @endif
                            </div>

                            <div class="pt-1.5">
                                <p class="text-sm font-semibold {{ $step['done'] ? 'text-slate-800' : 'text-slate-400' }}">{{ $step['label'] }}</p>
                                <p class="text-xs {{ $step['done'] ? 'text-slate-500' : 'text-slate-400' }} mt-0.5">{{ $step['desc'] }}</p>
                            </div>

                            @if($step['done'])
                                <span class="ml-auto text-xs font-medium text-emerald-600 flex items-center gap-1 pt-2">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    Selesai
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Documentation Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Dokumentasi</h3>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold border border-indigo-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $proker->dokumentasis->count() }} file
                    </span>
                </div>

                @if($proker->dokumentasis->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($proker->dokumentasis as $dok)
                            @php
                                $ext = strtolower(pathinfo($dok->file_path, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']);
                            @endphp
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($dok->file_path) }}" target="_blank" class="group block bg-slate-50 rounded-xl border border-slate-200 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                                @if($isImage)
                                    <div class="aspect-video bg-slate-100">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($dok->file_path) }}" alt="{{ $dok->keterangan ?? 'Dokumentasi' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-video bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-slate-200 transition-colors">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="p-3 flex items-center justify-between">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-medium text-slate-700 truncate">{{ $dok->keterangan ?? 'File dokumentasi' }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ strtoupper($ext) }} file</p>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-colors shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-600">Belum ada dokumentasi</p>
                        <p class="text-xs text-slate-400 mt-1">Ormawa terkait belum mengunggah bukti kegiatan</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Info Sidebar --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-5">Informasi Program</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Ormawa</p>
                            <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->nama }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Kategori Ormawa</p>
                            <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->kategori ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Fakultas</p>
                            <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->fakultas ?? 'Universitas' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-cyan-50 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Periode</p>
                            <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->periode ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Target Waktu</p>
                            <p class="text-sm font-semibold text-slate-800">{{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4">Riwayat Aktivitas</h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-xs text-slate-600">Program dibuat oleh <span class="font-semibold">Admin</span></p>
                            <p class="text-[10px] text-slate-400 mt-0.5">{{ $proker->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @if($proker->updated_at->ne($proker->created_at))
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-1.5 shrink-0"></div>
                            <div>
                                <p class="text-xs text-slate-600">Program diperbarui</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">{{ $proker->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                    @if($proker->status === 'selesai')
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 shrink-0"></div>
                            <div>
                                <p class="text-xs text-slate-600">Program selesai</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
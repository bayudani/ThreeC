<div class="max-w-5xl mx-auto space-y-6">
    {{-- Back Button --}}
    <a href="{{ route('admin.proker') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Kembali ke Program Kerja
    </a>

    {{-- Header Card --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        @php
            $statusBadge = match($proker->status) {
                'selesai' => 'bg-green-100 text-green-700',
                'berjalan' => 'bg-blue-100 text-blue-700',
                default => 'bg-slate-100 text-slate-600',
            };
            $statusText = match($proker->status) {
                'selesai' => 'Selesai',
                'berjalan' => 'Sedang Berjalan',
                default => 'Belum Dimulai',
            };
        @endphp

        <div class="p-8">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusBadge }}">{{ $statusText }}</span>
                        <span class="text-xs text-slate-400">Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d F Y') }}</span>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-900">{{ $proker->nama_proker }}</h1>
                </div>

                {{-- Ormawa Badge --}}
                <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 shrink-0">
                    @if($proker->ormawa->logo)
                        <img src="{{ $proker->ormawa->logoUrl() }}" alt="{{ $proker->ormawa->nama }}" class="w-10 h-10 object-contain rounded">
                    @else
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                            {{ substr($proker->ormawa->nama, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-xs text-slate-500">Ormawa</p>
                        <p class="text-sm font-bold text-slate-800">{{ $proker->ormawa->nama }}</p>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            @if($proker->deskripsi)
                <div class="mt-6 pt-6 border-t border-slate-100">
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $proker->deskripsi }}</p>
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Progress Card --}}
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-5">Progress</h3>

                <div class="space-y-4">
                    {{-- Progress Bar --}}
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="font-medium text-slate-700">Penyelesaian</span>
                            <span class="font-bold {{ $proker->progress >= 100 ? 'text-green-600' : 'text-blue-600' }}">{{ $proker->progress }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="h-3 rounded-full transition-all duration-500 {{ $proker->progress >= 100 ? 'bg-green-500' : 'bg-blue-600' }}" style="width: {{ $proker->progress }}%"></div>
                        </div>
                    </div>

                    {{-- Timeline Steps --}}
                    <div class="pt-4">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Tahapan</h4>
                        <div class="space-y-0">
                            @php
                                $steps = [
                                    ['label' => 'Perencanaan', 'done' => true],
                                    ['label' => 'Persiapan', 'done' => $proker->status !== 'belum_dimulai'],
                                    ['label' => 'Pelaksanaan', 'done' => $proker->status === 'berjalan' || $proker->status === 'selesai'],
                                    ['label' => 'Evaluasi & Laporan', 'done' => $proker->status === 'selesai'],
                                ];
                            @endphp

                            @foreach($steps as $i => $step)
                                <div class="flex items-start gap-4 pb-6 relative last:pb-0">
                                    {{-- Line connector --}}
                                    @if(!$loop->last)
                                        <div class="absolute left-[15px] top-8 bottom-0 w-px {{ $steps[$i+1]['done'] ? 'bg-blue-500' : 'bg-slate-200' }}"></div>
                                    @endif

                                    {{-- Circle --}}
                                    <div class="w-[30px] h-[30px] rounded-full flex items-center justify-center shrink-0 z-10 {{ $step['done'] ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-400' }}">
                                        @if($step['done'])
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        @else
                                            <span class="text-xs font-bold">{{ $i + 1 }}</span>
                                        @endif
                                    </div>

                                    {{-- Content --}}
                                    <div class="pt-1">
                                        <p class="text-sm font-semibold {{ $step['done'] ? 'text-slate-800' : 'text-slate-400' }}">{{ $step['label'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Documentation --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Dokumentasi</h3>
                    <span class="text-xs text-slate-400">{{ $proker->dokumentasis->count() }} file</span>
                </div>

                @if($proker->dokumentasis->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($proker->dokumentasis as $dok)
                            <div class="group relative bg-slate-50 rounded-xl border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                                @php
                                    $ext = strtolower(pathinfo($dok->file_path, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']);
                                @endphp

                                @if($isImage)
                                    <div class="aspect-video bg-slate-100">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($dok->file_path) }}" alt="{{ $dok->keterangan ?? 'Dokumentasi' }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="aspect-video bg-slate-100 flex items-center justify-center text-slate-400">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                @endif

                                <div class="p-3">
                                    <p class="text-xs font-medium text-slate-700 truncate">{{ $dok->keterangan ?? 'File dokumentasi' }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ strtoupper($ext) }} file</p>
                                </div>

                                <a href="{{ \Illuminate\Support\Facades\Storage::url($dok->file_path) }}" target="_blank" class="absolute inset-0 z-10">
                                    <span class="sr-only">Lihat dokumentasi</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-sm text-slate-500">Belum ada dokumentasi.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar Info --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4">Informasi</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-slate-400">Ormawa</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Kategori Ormawa</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->kategori }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Fakultas</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->fakultas ?? 'Universitas' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Periode</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $proker->ormawa->periode ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Target Waktu</p>
                        <p class="text-sm font-semibold text-slate-800">{{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Dibuat</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $proker->created_at->translatedFormat('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Terakhir Diperbarui</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $proker->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

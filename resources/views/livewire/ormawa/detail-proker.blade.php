<div class="max-w-7xl mx-auto space-y-6">
    
    <!-- Tombol Kembali & Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('ormawa.proker') }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Detail Program Kerja</h2>
            <p class="text-sm text-slate-500">Kelola progres dan arsip dokumen untuk program ini.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- KOLOM KIRI: Informasi & Update Progress (Span 2) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Info Card -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 relative overflow-hidden">
                @php
                    $statusColor = match($proker->status) {
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
                <div class="absolute top-0 right-0 p-6">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $statusColor }} uppercase tracking-wider">
                        {{ $statusText }}
                    </span>
                </div>

                <h3 class="text-xl font-bold text-slate-800 pr-32">{{ $proker->nama_proker }}</h3>
                <div class="flex items-center gap-4 mt-2 text-sm text-slate-500 font-medium">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d F Y') }}
                    </span>
                </div>
                
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <p class="text-sm text-slate-600 leading-relaxed">
                        {{ $proker->deskripsi ?? 'Tidak ada deskripsi rinci untuk program kerja ini.' }}
                    </p>
                </div>
            </div>

            <!-- Progress Update Card -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Update Progress Pelaksanaan
                </h3>

                @if (session()->has('success_progress'))
                    <div class="p-3 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success_progress') }}
                    </div>
                @endif

                <form wire:submit.prevent="updateProgress" class="space-y-6">
                    <div>
                        <div class="flex justify-between items-end mb-2">
                            <label class="block text-sm font-semibold text-slate-700">Persentase Penyelesaian</label>
                            <span class="text-2xl font-black {{ $progress == 100 ? 'text-green-600' : 'text-blue-600' }}">{{ $progress }}%</span>
                        </div>
                        <input wire:model.live="progress" type="range" min="0" max="100" class="w-full h-3 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                    </div>

                    <div class="flex gap-4 items-end">
                        <div class="flex-1">
                            <label class="block mb-2 text-sm font-semibold text-slate-700">Status Saat Ini</label>
                            <select wire:model="status" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="belum_dimulai">Belum Dimulai</option>
                                <option value="berjalan">Sedang Berjalan</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-medium rounded-lg transition-all flex items-center gap-2">
                            <span wire:loading.remove wire:target="updateProgress">Simpan Progress</span>
                            <span wire:loading wire:target="updateProgress" style="display: none;">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- KOLOM KANAN: Dokumentasi (Span 1) -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col h-full">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    File Laporan / Bukti
                </h3>
            </div>

            <!-- List Dokumen -->
            <div class="p-0 flex-1 overflow-y-auto min-h-[200px]">
                @if (session()->has('success_dokumen'))
                    <div class="m-4 p-3 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200">
                        {{ session('success_dokumen') }}
                    </div>
                @endif

                <div class="divide-y divide-slate-100">
                    @forelse($proker->dokumentasis as $dokumen)
                        <div class="p-4 flex items-start gap-3 hover:bg-slate-50 transition-colors">
                            <div class="w-10 h-10 rounded bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                                @if(Str::endsWith($dokumen->file_path, ['.pdf']))
                                    <span class="font-bold text-xs">PDF</span>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $dokumen->keterangan }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $dokumen->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ Storage::url($dokumen->file_path) }}" download class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Unduh file">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </a>
                                <button wire:click="hapusDokumen({{ $dokumen->id }})" wire:confirm="Yakin ingin menghapus dokumen ini?" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center flex flex-col items-center text-slate-500">
                            <svg class="w-10 h-10 mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                            <p class="text-sm">Belum ada file diunggah.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Form Upload Box -->
            <div class="p-5 bg-slate-50 border-t border-slate-200 mt-auto">
                <form wire:submit.prevent="uploadDokumen" class="space-y-3"
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true; progress = 0"
                    x-on:livewire-upload-finish="uploading = false; progress = 100"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div>
                        <input wire:model="keterangan_file" type="text" class="bg-white border border-slate-300 text-slate-900 text-xs rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2" placeholder="Keterangan file (cth: LPJ, Foto)...">
                        @error('keterangan_file') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <input wire:model="file_bukti" type="file" accept=".jpg,.jpeg,.png,.pdf" class="block w-full text-xs text-slate-900 border border-slate-300 rounded-lg cursor-pointer bg-white focus:outline-none p-1.5">
                        @error('file_bukti') <span class="text-red-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if($file_bukti && !$errors->has('file_bukti'))
                        <div class="flex items-center gap-2 p-2 bg-white rounded-lg border border-slate-200">
                            @php
                                $tmpExt = strtolower($file_bukti->getClientOriginalExtension());
                                $tmpIsImage = in_array($tmpExt, ['jpg', 'jpeg', 'png']);
                            @endphp
                            @if($tmpIsImage)
                                <img src="{{ $file_bukti->temporaryUrl() }}" class="w-10 h-10 object-cover rounded-md border border-slate-200 shrink-0">
                            @else
                                <div class="w-10 h-10 rounded-md border border-slate-200 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <p class="text-[11px] font-semibold text-slate-700 truncate">{{ $file_bukti->getClientOriginalName() }}</p>
                                <p class="text-[10px] text-slate-400">{{ round($file_bukti->getSize() / 1024) }} KB • {{ strtoupper($tmpExt) }}</p>
                            </div>
                            <span class="text-[10px] font-bold text-emerald-600">Siap</span>
                        </div>
                    @endif

                    <div x-show="uploading" x-cloak>
                        <div class="flex items-center justify-between text-[10px] font-semibold text-slate-600 mb-1">
                            <span>Mengunggah...</span>
                            <span x-text="progress + '%'"></span>
                        </div>
                        <div class="w-full bg-white rounded-full h-1.5 overflow-hidden border border-slate-200">
                            <div class="h-1.5 rounded-full bg-blue-600 transition-all duration-200" x-bind:style="'width: ' + progress + '%'"></div>
                        </div>
                    </div>

                    <button type="submit" wire:loading.attr="disabled" class="w-full py-2 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-xs font-bold rounded-lg transition-all flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="uploadDokumen">Upload File</span>
                        <span wire:loading wire:target="uploadDokumen" style="display: none;" class="flex items-center gap-2">
                            <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Mengunggah...
                        </span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
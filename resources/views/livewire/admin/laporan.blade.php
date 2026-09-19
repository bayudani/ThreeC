<div class="max-w-7xl mx-auto space-y-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Laporan</h2>
            <p class="text-sm text-slate-500">Dokumentasi dan laporan progres program kerja dari seluruh ormawa.</p>
        </div>
        @if(Auth::user()->role === 'admin_ormawa')
            <button wire:click="$set('showUpload', true)" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Upload Laporan
            </button>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Laporan</p>
            <h3 class="text-3xl font-bold text-blue-700 mt-2">{{ $stats['total'] }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Bulan Ini</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['bulanIni'] }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Gambar</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['gambar'] }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Dokumen</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['dokumen'] }}</h3>
        </div>
    </div>

    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm space-y-3">
        <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-thin">
            <button wire:click="setOrmawa('')" class="px-3 py-1.5 text-xs font-medium rounded-full border transition-colors whitespace-nowrap shrink-0 {{ $filterOrmawa === '' ? 'bg-slate-800 border-slate-800 text-white' : 'bg-white border-slate-300 text-slate-600 hover:bg-slate-50' }}">
                Semua Ormawa
            </button>
            @foreach($ormawas as $o)
                <button wire:click="setOrmawa('{{ $o->id }}')" class="px-3 py-1.5 text-xs font-medium rounded-full border transition-colors whitespace-nowrap shrink-0 {{ $filterOrmawa == $o->id ? 'bg-slate-800 border-slate-800 text-white' : 'bg-white border-slate-300 text-slate-600 hover:bg-slate-50' }}">
                    {{ $o->nama }}
                </button>
            @endforeach
        </div>

        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-9 p-2.5" placeholder="Cari laporan...">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($laporan as $dok)
            @php
                $ext = strtolower(pathinfo($dok->file_path, PATHINFO_EXTENSION));
                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                $isPdf = $ext === 'pdf';
                $isExcel = in_array($ext, ['xls', 'xlsx']);
                $isDoc = in_array($ext, ['doc', 'docx']);
                $fileIcon = match(true) {
                    $isPdf => 'text-red-500',
                    $isExcel => 'text-green-600',
                    $isDoc => 'text-blue-600',
                    default => 'text-slate-400',
                };
            @endphp
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow flex flex-col">
                @if($isImage)
                    <div class="h-40 bg-slate-100 relative group cursor-pointer overflow-hidden" wire:click="preview({{ $dok->id }})">
                        <img src="{{ Storage::url($dok->file_path) }}" alt="{{ $dok->keterangan ?? 'Laporan' }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                            <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                @else
                    <div class="h-40 bg-slate-50 flex items-center justify-center" wire:click="preview({{ $dok->id }})">
                        <svg class="w-12 h-12 {{ $fileIcon }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                @endif

                <div class="p-4 flex-1 flex flex-col">
                    <p class="text-xs text-slate-400 mb-1">{{ $dok->proker->ormawa->nama }} • {{ $dok->proker->nama_proker }}</p>
                    <p class="text-sm font-semibold text-slate-800 line-clamp-2">{{ $dok->keterangan ?? 'Laporan ' . $dok->proker->nama_proker }}</p>
                    <div class="mt-auto pt-3 flex items-center justify-between">
                        <span class="text-xs text-slate-400">{{ $dok->created_at->translatedFormat('d M Y') }}</span>
                        <a href="{{ Storage::url($dok->file_path) }}" download class="text-xs font-medium text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Unduh
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <p class="text-slate-500 font-medium">Belum ada laporan.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $laporan->links(data: ['scrollTo' => false]) }}
    </div>

    {{-- Modal Upload (Admin Ormawa only) --}}
    @if($showUpload)
        <div class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4" wire:key="upload-modal">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between p-6 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Upload Laporan</h3>
                    </div>
                    <button wire:click="resetUpload" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit="upload" class="p-6 space-y-5"
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true; progress = 0"
                    x-on:livewire-upload-finish="uploading = false; progress = 100"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Program Kerja</label>
                        <select wire:model="proker_id" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm px-3 py-2.5">
                            <option value="">Pilih proker</option>
                            @foreach($prokers as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_proker }}</option>
                            @endforeach
                        </select>
                        @error('proker_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">File (PDF, Excel, Gambar)</label>
                        <div class="relative border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-blue-300 hover:bg-blue-50/30 transition-all cursor-pointer">
                            <input wire:model="file" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.gif" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="text-sm text-slate-500">Klik untuk pilih file</p>
                            <p class="text-xs text-slate-400 mt-1">PDF, Word, Excel, atau gambar — maks 10MB</p>
                        </div>
                        @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                        @if($file && !$errors->has('file'))
                            <div class="mt-3 flex items-center gap-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                @php
                                    $tmpExt = strtolower($file->getClientOriginalExtension());
                                    $tmpIsImage = in_array($tmpExt, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if($tmpIsImage)
                                    <img src="{{ $file->temporaryUrl() }}" class="w-14 h-14 object-cover rounded-md border border-slate-200 shrink-0">
                                @else
                                    <div class="w-14 h-14 rounded-md bg-white border border-slate-200 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-slate-700 truncate">{{ $file->getClientOriginalName() }}</p>
                                    <p class="text-xs text-slate-400">{{ round($file->getSize() / 1024) }} KB • {{ strtoupper($tmpExt) }}</p>
                                </div>
                                <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    Siap
                                </span>
                            </div>
                        @endif

                        <div x-show="uploading" x-cloak class="mt-3">
                            <div class="flex items-center justify-between text-xs font-semibold text-slate-600 mb-1.5">
                                <span>Mengunggah file...</span>
                                <span x-text="progress + '%'"></span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                <div class="h-2 rounded-full bg-blue-600 transition-all duration-200" x-bind:style="'width: ' + progress + '%'"></div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Keterangan</label>
                        <input wire:model="keterangan" type="text" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm px-3 py-2.5" placeholder="Deskripsi laporan...">
                        @error('keterangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                        <button type="button" wire:click="resetUpload" class="px-5 py-2.5 border border-slate-300 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-all">Batal</button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="upload" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm flex items-center gap-2">
                            <span wire:loading.remove wire:target="upload">Upload</span>
                            <span wire:loading wire:target="upload" style="display: none;" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Mengunggah...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal Preview --}}
    @if($previewUrl)
        <div class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4" wire:click.self="tutupPreview" wire:key="preview-modal">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl max-h-[92vh] overflow-hidden flex flex-col">
                <div class="flex items-center justify-between gap-3 px-5 py-3.5 border-b border-slate-200 shrink-0">
                    <div class="flex items-center gap-3 min-w-0">
                        @php
                            $ext = strtolower(pathinfo($previewUrl, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                            $isPdf = $ext === 'pdf';
                        @endphp
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center {{ $isImage ? 'bg-emerald-50 text-emerald-600' : ($isPdf ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600') }} shrink-0">
                            @if($isImage)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @elseif($isPdf)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $previewKeterangan ?? 'Preview' }}</p>
                            <p class="text-xs text-slate-400">
                                <span class="uppercase font-bold">{{ $ext }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a href="{{ $previewUrl }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5h7v7m-7-7L22 15v6M8 14H5a2 2 0 01-2-2V5a2 2 0 012-2h6"></path></svg>
                            Buka
                        </a>
                        <a href="{{ $previewUrl }}" download class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Unduh
                        </a>
                        <button wire:click="tutupPreview" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
                <div class="flex-1 flex items-center justify-center bg-slate-100 p-4 overflow-auto min-h-[300px]">
                    @if($isImage)
                        <img src="{{ $previewUrl }}" alt="Preview" class="max-w-full max-h-[65vh] object-contain rounded-lg shadow-sm bg-white">
                    @elseif($isPdf)
                        <iframe src="{{ $previewUrl }}" class="w-full h-[65vh] bg-white rounded-lg shadow-sm" title="Preview PDF"></iframe>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <p class="text-slate-500 mb-4">Preview tidak tersedia untuk tipe file ini.</p>
                            <a href="{{ $previewUrl }}" download class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl inline-flex items-center gap-2 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh File
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

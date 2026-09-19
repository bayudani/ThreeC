<div class="max-w-7xl mx-auto space-y-6">
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800">Dokumentasi &amp; Laporan</h2>
            <p class="text-sm text-slate-500 mt-0.5">Unggah dan kelola dokumen program kerja</p>
        </div>
        <button wire:click="$set('showUpload', true)" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Upload Dokumen
        </button>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Dokumen</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Bulan Ini</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['bulanIni'] }}</p>
        </div>
    </div>

    @if($showUpload)
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Upload Dokumen Baru</h3>
        <form wire:submit="upload" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Program Kerja</label>
                <select wire:model="proker_id" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Pilih Proker --</option>
                    @foreach($prokers as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_proker }}</option>
                    @endforeach
                </select>
                @error('proker_id') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">File</label>
                <input type="file" wire:model="file" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('file') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
                <div wire:loading wire:target="file" class="text-xs text-blue-600 mt-1">Mengupload...</div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Keterangan</label>
                <input type="text" wire:model="keterangan" placeholder="Opsional" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">Upload</button>
                <button type="button" wire:click="resetUpload" class="px-4 py-2 bg-white text-slate-600 text-sm font-semibold rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">Batal</button>
            </div>
        </form>
    </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4">
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" wire:model.live="search" placeholder="Cari dokumen..." class="w-full sm:w-64 rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <select wire:model.live="filterProker" class="rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Proker</option>
                @foreach($prokers as $p)
                <option value="{{ $p->id }}">{{ $p->nama_proker }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($laporan as $d)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <div class="p-5">
                <div class="flex items-start justify-between">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <button wire:click="delete({{ $d->id }})" wire:confirm="Hapus dokumen ini?" class="p-1 text-slate-300 hover:text-red-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
                <div class="mt-3">
                    <p class="text-sm font-semibold text-slate-800">{{ $d->proker->nama_proker }}</p>
                    @if($d->keterangan)
                    <p class="text-xs text-slate-500 mt-1">{{ $d->keterangan }}</p>
                    @endif
                    <p class="text-xs text-slate-400 mt-2">{{ $d->created_at->isoFormat('D MMM Y, HH:mm') }}</p>
                </div>
            </div>
            <div class="border-t border-slate-100 px-5 py-3 bg-slate-50/50 flex items-center justify-between">
                <span class="text-[10px] font-semibold uppercase text-slate-400">{{ strtoupper(pathinfo($d->file_path, PATHINFO_EXTENSION)) }}</span>
                <button wire:click="preview({{ $d->id }})" class="text-xs font-semibold text-blue-600 hover:text-blue-800">Lihat</button>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-slate-400">Belum ada dokumen.</div>
        @endforelse
    </div>

    @if($laporan->hasPages())
    <div class="mt-4">
        {{ $laporan->links() }}
    </div>
    @endif

    @if($previewUrl)
    <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" wire:click.self="tutupPreview">
        <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <p class="text-sm font-semibold text-slate-800">Preview Dokumen</p>
                <button wire:click="tutupPreview" class="p-1 text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-4 overflow-auto max-h-[calc(90vh-80px)]">
                @if(in_array(strtolower(pathinfo($previewUrl, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif']))
                <img src="{{ $previewUrl }}" class="max-w-full rounded-lg mx-auto">
                @else
                <div class="text-center py-12">
                    <p class="text-sm text-slate-500 mb-4">File tidak bisa ditampilkan secara langsung.</p>
                    <a href="{{ $previewUrl }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download &amp; Buka File
                    </a>
                </div>
                @endif
                @if($previewKeterangan)
                <p class="text-sm text-slate-600 mt-4 italic">&ldquo;{{ $previewKeterangan }}&rdquo;</p>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

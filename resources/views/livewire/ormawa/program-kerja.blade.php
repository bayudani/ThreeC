<div class="max-w-7xl mx-auto space-y-6">
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800">Program Kerja</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola program kerja ormawa Anda</p>
        </div>
        <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Proker
        </button>
    </div>

    <div class="grid grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm text-center">
            <p class="text-2xl font-bold text-indigo-700">{{ $stats['total'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Total</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm text-center">
            <p class="text-2xl font-bold text-green-600">{{ $stats['selesai'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Selesai</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm text-center">
            <p class="text-2xl font-bold text-blue-600">{{ $stats['berjalan'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Berjalan</p>
        </div>
        <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm text-center">
            <p class="text-2xl font-bold text-slate-800">{{ $stats['belum'] }}</p>
            <p class="text-xs text-slate-500 mt-0.5">Belum Dimulai</p>
        </div>
    </div>

    <div class="flex gap-2 flex-wrap">
        <button wire:click="$set('filterStatus', '')"
            class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors
            {{ $filterStatus === '' ? 'bg-blue-600 text-white shadow' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
            Semua
        </button>
        <button wire:click="$set('filterStatus', 'belum_dimulai')"
            class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors
            {{ $filterStatus === 'belum_dimulai' ? 'bg-slate-700 text-white shadow' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
            Belum Dimulai
        </button>
        <button wire:click="$set('filterStatus', 'berjalan')"
            class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors
            {{ $filterStatus === 'berjalan' ? 'bg-blue-600 text-white shadow' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
            Berjalan
        </button>
        <button wire:click="$set('filterStatus', 'selesai')"
            class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors
            {{ $filterStatus === 'selesai' ? 'bg-green-600 text-white shadow' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
            Selesai
        </button>
    </div>

    @if($showForm)
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">{{ $editId ? 'Edit Proker' : 'Tambah Proker Baru' }}</h3>
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Program Kerja</label>
                <input type="text" wire:model="nama_proker" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('nama_proker') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="3" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Target Waktu</label>
                    <input type="date" wire:model="target_waktu" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('target_waktu') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Status</label>
                    <select wire:model="status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="belum_dimulai">Belum Dimulai</option>
                        <option value="berjalan">Berjalan</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Progress (%)</label>
                    <input type="number" min="0" max="100" wire:model="progress" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('progress') <span class="text-xs text-red-500 mt-0.5 block">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    {{ $editId ? 'Simpan Perubahan' : 'Simpan' }}
                </button>
                <button type="button" wire:click="resetForm" class="px-4 py-2 bg-white text-slate-600 text-sm font-semibold rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100">
            <input type="text" wire:model.live="search" placeholder="Cari proker..." class="w-full sm:w-64 rounded-lg border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                        <th class="text-left px-4 py-3">Nama Proker</th>
                        <th class="text-left px-4 py-3">Target</th>
                        <th class="text-center px-4 py-3">Progress</th>
                        <th class="text-center px-4 py-3">Status</th>
                        <th class="text-center px-4 py-3">Dokumen</th>
                        <th class="text-center px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($prokers as $p)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-3">
                            <p class="font-semibold text-slate-800">{{ $p->nama_proker }}</p>
                            @if($p->deskripsi)
                            <p class="text-xs text-slate-400 mt-0.5 truncate max-w-xs">{{ $p->deskripsi }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ \Carbon\Carbon::parse($p->target_waktu)->isoFormat('D MMM Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2 justify-center">
                                <div class="w-20 bg-slate-100 rounded-full h-1.5">
                                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $p->progress }}%"></div>
                                </div>
                                <span class="text-xs font-bold text-slate-600">{{ $p->progress }}%</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded
                                {{ $p->status === 'selesai' ? 'bg-green-50 text-green-700' : ($p->status === 'berjalan' ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-500') }}">
                                {{ str_replace('_', ' ', ucwords($p->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center text-slate-500">{{ $p->dokumentasis_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1">
                                <button wire:click="edit({{ $p->id }})" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button wire:click="delete({{ $p->id }})" wire:confirm="Hapus proker ini?" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center px-4 py-10 text-slate-400">Belum ada program kerja.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($prokers->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $prokers->links() }}
        </div>
        @endif
    </div>
</div>

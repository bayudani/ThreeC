<div class="max-w-7xl mx-auto space-y-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Ormawa</h2>
            <p class="text-sm text-slate-500">Kelola data seluruh Organisasi Mahasiswa di kampus.</p>
        </div>
        <button wire:click="tambah" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Ormawa
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Ormawa</p>
            <h3 class="text-3xl font-bold text-blue-700 mt-2">{{ $stats['total'] }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Legislatif</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['legislatif'] }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Eksekutif</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['eksekutif'] }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-slate-200 shadow-sm">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">UKM</p>
            <h3 class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['ukm'] }}</h3>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex flex-wrap gap-2">
            <button wire:click="setKategori('')" class="px-4 py-1.5 text-sm font-medium rounded-full border transition-colors {{ $filterKategori === '' ? 'bg-blue-700 border-blue-700 text-white' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                Semua
            </button>
            <button wire:click="setKategori('Legislatif')" class="px-4 py-1.5 text-sm font-medium rounded-full border transition-colors {{ $filterKategori === 'Legislatif' ? 'bg-blue-700 border-blue-700 text-white' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                Legislatif
            </button>
            <button wire:click="setKategori('Eksekutif')" class="px-4 py-1.5 text-sm font-medium rounded-full border transition-colors {{ $filterKategori === 'Eksekutif' ? 'bg-blue-700 border-blue-700 text-white' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                Eksekutif
            </button>
            <button wire:click="setKategori('UKM')" class="px-4 py-1.5 text-sm font-medium rounded-full border transition-colors {{ $filterKategori === 'UKM' ? 'bg-blue-700 border-blue-700 text-white' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                UKM
            </button>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-64">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-9 p-2" placeholder="Cari nama ormawa...">
            </div>

            <div class="flex bg-slate-100 p-1 rounded-lg border border-slate-200">
                <button wire:click="setViewMode('card')" class="p-1.5 rounded-md transition-colors {{ $viewMode === 'card' ? 'bg-white shadow text-blue-600' : 'text-slate-500 hover:text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </button>
                <button wire:click="setViewMode('table')" class="p-1.5 rounded-md transition-colors {{ $viewMode === 'table' ? 'bg-white shadow text-blue-600' : 'text-slate-500 hover:text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>

    @if($viewMode === 'card')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($ormawas as $ormawa)
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    @if($ormawa->logo)
                        <div class="h-32 bg-slate-100 relative flex items-center justify-center p-4">
                            <img src="{{ $ormawa->logoUrl() }}" alt="{{ $ormawa->nama }}" class="h-full object-contain">
                        </div>
                    @else
                        <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600 relative p-4 flex items-end">
                            <span class="absolute top-3 right-3 px-2 py-1 bg-white/90 backdrop-blur text-green-700 text-[10px] font-bold rounded shadow-sm">
                                AKTIF
                            </span>
                        </div>
                    @endif

                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-slate-800 line-clamp-1" title="{{ $ormawa->nama }}">{{ $ormawa->nama }}</h3>
                        <p class="text-sm text-slate-500 mb-4">{{ $ormawa->fakultas ?? 'Universitas' }}</p>

                        <div class="mt-auto grid grid-cols-2 gap-4 border-t border-slate-100 pt-4 mb-4">
                            <div>
                                <p class="text-xs text-slate-400 font-medium">Periode</p>
                                <p class="text-sm text-slate-700 font-semibold">{{ $ormawa->periode ?? '2024-2025' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-medium">Kategori</p>
                                <p class="text-sm text-slate-700 font-semibold">{{ $ormawa->kategori }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-2">
                            <button wire:click="edit({{ $ormawa->id }})" class="flex-1 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors">
                                Edit
                            </button>
                            <button wire:click="confirmDelete({{ $ormawa->id }})" class="p-2 border border-slate-300 hover:bg-red-50 hover:text-red-600 hover:border-red-200 text-slate-600 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($ormawas->onFirstPage() && $search === '' && $filterKategori === '')
                <button wire:click="tambah" class="bg-slate-50/50 rounded-xl border-2 border-dashed border-slate-300 hover:border-blue-500 hover:bg-blue-50/50 transition-colors flex flex-col items-center justify-center p-6 h-full min-h-[320px] text-slate-500 hover:text-blue-600">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 border border-slate-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <span class="font-semibold text-slate-700">Daftarkan Ormawa Baru</span>
                    <span class="text-sm text-center mt-1">Mulai proses pendaftaran resmi</span>
                </button>
            @endif
        </div>
    @else
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Logo</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Nama Organisasi</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Kategori</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Fakultas</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Periode</th>
                            <th scope="col" class="px-6 py-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ormawas as $ormawa)
                            <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    @if($ormawa->logo)
                                        <img src="{{ $ormawa->logoUrl() }}" alt="{{ $ormawa->nama }}" class="w-10 h-10 object-contain rounded">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                                            {{ substr($ormawa->nama, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $ormawa->nama }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded-full">{{ $ormawa->kategori }}</span>
                                </td>
                                <td class="px-6 py-4">{{ $ormawa->fakultas ?? 'Universitas' }}</td>
                                <td class="px-6 py-4">{{ $ormawa->periode ?? '2024-2025' }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="edit({{ $ormawa->id }})" class="font-medium text-blue-600 hover:text-blue-800">Edit</button>
                                    <button wire:click="confirmDelete({{ $ormawa->id }})" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">Tidak ada data ormawa ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-6">
        {{ $ormawas->links(data: ['scrollTo' => false]) }}
    </div>

    {{-- Modal Form Tambah/Edit --}}
    @if($showForm)
        <div class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between p-6 border-b border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800">{{ $editId ? 'Edit Ormawa' : 'Tambah Ormawa' }}</h3>
                    <button wire:click="batal" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit="save" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Organisasi</label>
                        <input wire:model="nama" type="text" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                        <select wire:model="kategori" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="">Pilih kategori</option>
                            <option value="Legislatif">Legislatif</option>
                            <option value="Eksekutif">Eksekutif</option>
                            <option value="UKM">UKM</option>
                        </select>
                        @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Fakultas</label>
                        <input wire:model="fakultas" type="text" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Contoh: FTI">
                        @error('fakultas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Periode</label>
                        <input wire:model="periode" type="text" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Contoh: 2024-2025">
                        @error('periode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Logo / Foto Organisasi</label>
                        <input wire:model="logo" type="file" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                        @if($logo && !$errors->has('logo'))
                            <div class="mt-3">
                                <img src="{{ $logo->temporaryUrl() }}" class="h-20 w-auto object-contain rounded border">
                            </div>
                        @elseif($existingLogo)
                            <div class="mt-3">
                                <img src="{{ Storage::url($existingLogo) }}" class="h-20 w-auto object-contain rounded border">
                                <p class="text-xs text-slate-400 mt-1">Logo saat ini</p>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" wire:click="batal" class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors">{{ $editId ? 'Simpan' : 'Tambah' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal Konfirmasi Hapus --}}
    @if($confirmDeleteId)
        <div class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 text-center">
                <div class="w-14 h-14 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Ormawa?</h3>
                <p class="text-sm text-slate-500 mb-6">Data ormawa dan seluruh program kerjanya akan dihapus permanen. Tindakan ini tidak bisa dibatalkan.</p>
                <div class="flex justify-center gap-3">
                    <button wire:click="batalHapus" class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">Batal</button>
                    <button wire:click="delete" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">Ya, Hapus</button>
                </div>
            </div>
        </div>
    @endif
</div>

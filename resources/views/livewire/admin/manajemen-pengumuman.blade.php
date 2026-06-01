<div class="max-w-7xl mx-auto space-y-6">
    
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold">Berhasil!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Pusat Informasi & Pengumuman</h2>
            <p class="text-sm text-slate-500">Siarkan informasi, jadwal kegiatan, atau peringatan ke seluruh Ormawa.</p>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
            Buat Pengumuman
        </button>
    </div>

    <!-- Grid Pengumuman -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @forelse($pengumumans as $item)
            @php
                $borderColor = match($item->tipe) {
                    'mendesak' => 'border-t-red-500',
                    'info' => 'border-t-blue-500',
                    'kegiatan' => 'border-t-slate-400',
                    default => 'border-t-slate-300',
                };
                $badgeColor = match($item->tipe) {
                    'mendesak' => 'bg-red-50 text-red-600',
                    'info' => 'bg-blue-50 text-blue-600',
                    'kegiatan' => 'bg-slate-100 text-slate-600',
                    default => 'bg-slate-50 text-slate-500',
                };
            @endphp
            
            <div class="bg-white rounded-xl border border-slate-200 border-t-4 {{ $borderColor }} shadow-sm flex flex-col overflow-hidden hover:shadow-md transition-shadow relative {{ !$item->is_active ? 'opacity-60 grayscale-[50%]' : '' }}">
                
                @if(!$item->is_active)
                    <div class="absolute inset-0 bg-slate-50/50 backdrop-blur-[1px] z-10 pointer-events-none"></div>
                @endif

                <div class="p-6 flex-1 z-20">
                    <div class="flex justify-between items-start mb-3">
                        <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded {{ $badgeColor }}">
                            {{ $item->tipe }}
                        </span>
                        <span class="text-xs text-slate-400 font-medium">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-800 mb-2 leading-tight">{{ $item->judul }}</h3>
                    <p class="text-sm text-slate-600 line-clamp-4">{{ $item->isi }}</p>
                </div>
                
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between z-20">
                    <button wire:click="toggleStatus({{ $item->id }})" class="text-xs font-semibold {{ $item->is_active ? 'text-amber-600 hover:text-amber-700' : 'text-green-600 hover:text-green-700' }} transition-colors">
                        {{ $item->is_active ? 'Sembunyikan' : 'Tampilkan' }}
                    </button>
                    
                    <button wire:click="hapus({{ $item->id }})" wire:confirm="Yakin ingin menghapus pengumuman ini secara permanen?" class="text-xs font-semibold text-red-600 hover:text-red-700 transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 flex flex-col items-center justify-center text-slate-500 bg-white rounded-xl border border-slate-200 border-dashed">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                </div>
                <p class="font-medium text-slate-700">Belum ada pengumuman disiarkan.</p>
                <p class="text-sm mt-1">Buat pengumuman pertama Anda untuk Ormawa.</p>
            </div>
        @endforelse
    </div>

    <!-- MODAL BUAT PENGUMUMAN -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/50 backdrop-blur-sm p-4">
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" 
                 @click.away="$wire.closeModal()">
                
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Buat Pengumuman Baru</h3>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit.prevent="simpan" class="p-6 space-y-4">
                    
                    <div>
                        <label for="judul" class="block mb-2 text-sm font-semibold text-slate-700">Judul Pengumuman</label>
                        <input wire:model="judul" type="text" id="judul" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: Batas Akhir Upload Laporan Q3">
                        @error('judul') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="tipe" class="block mb-2 text-sm font-semibold text-slate-700">Jenis Informasi</label>
                        <select wire:model="tipe" id="tipe" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="info">Informasi Umum (Info)</option>
                            <option value="mendesak">Peringatan Mendesak (Mendesak)</option>
                            <option value="kegiatan">Agenda / Kegiatan (Kegiatan)</option>
                        </select>
                        @error('tipe') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="isi" class="block mb-2 text-sm font-semibold text-slate-700">Isi Pesan</label>
                        <textarea wire:model="isi" id="isi" rows="4" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tulis rincian informasi di sini..."></textarea>
                        @error('isi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 mt-6 border-t border-slate-100">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                            <span wire:loading.remove wire:target="simpan">Kirim Pengumuman</span>
                            <span wire:loading wire:target="simpan">Menyiarkan...</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif

</div>
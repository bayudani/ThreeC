<div class="max-w-7xl mx-auto space-y-6">
    
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold">Berhasil!</span> {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Program Kerja</h2>
            <p class="text-sm text-slate-500">Kelola progres dan unggah bukti laporan kegiatan ormawa Anda.</p>
        </div>
        
        <div class="relative w-full md:w-72">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" class="bg-white border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-9 p-2.5 shadow-sm" placeholder="Cari program kerja...">
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold w-1/3">Nama Program</th>
                        <th scope="col" class="px-6 py-4 font-semibold text-center">Status</th>
                        <th scope="col" class="px-6 py-4 font-semibold w-48">Progress</th>
                        <th scope="col" class="px-6 py-4 font-semibold text-center">Bukti Laporan</th>
                        <th scope="col" class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prokers as $proker)
                        @php
                            $statusColor = match($proker->status) {
                                'selesai' => ['badge' => 'bg-green-100 text-green-700', 'bar' => 'bg-green-500'],
                                'berjalan' => ['badge' => 'bg-blue-100 text-blue-700', 'bar' => 'bg-blue-600'],
                                default => ['badge' => 'bg-slate-100 text-slate-600', 'bar' => 'bg-slate-400'],
                            };
                            $statusText = match($proker->status) {
                                'selesai' => 'Selesai',
                                'berjalan' => 'Berjalan',
                                default => 'Belum Dimulai',
                            };
                            $docCount = $proker->dokumentasis->count();
                        @endphp
                        <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">{{ $proker->nama_proker }}</p>
                                <p class="text-xs text-slate-500 mt-1">Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M Y') }}</p>
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
                            <td class="px-6 py-4 text-center">
                                @if($docCount > 0)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $docCount }} File
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400 italic">Belum ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('ormawa.proker.detail', $proker->id) }}" class="px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white text-sm font-semibold rounded-lg transition-colors inline-block">
                                    Kelola Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <p class="font-medium">Belum ada program kerja yang didaftarkan.</p>
                                <p class="text-sm mt-1">Gunakan Dashboard untuk menambah proker baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $prokers->links(data: ['scrollTo' => false]) }}
    </div>

    @if($isProgressModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/50 backdrop-blur-sm p-4">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" @click.away="$wire.closeProgressModal()">
                
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Update Progress</h3>
                    <button wire:click="closeProgressModal" class="text-slate-400 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit.prevent="updateProgress" class="p-6 space-y-4">
                    
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Persentase Selesai: <span class="text-blue-600">{{ $progress }}%</span></label>
                        <input wire:model.live="progress" type="range" min="0" max="100" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                        @error('progress') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Status Saat Ini</label>
                        <select wire:model="status" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="belum_dimulai">Belum Dimulai</option>
                            <option value="berjalan">Sedang Berjalan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 mt-6 border-t border-slate-100">
                        <button type="button" wire:click="closeProgressModal" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($isDokumenModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/50 backdrop-blur-sm p-4">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" @click.away="$wire.closeDokumenModal()">
                
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Upload Bukti Laporan</h3>
                    <button wire:click="closeDokumenModal" class="text-slate-400 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit.prevent="uploadDokumen" class="p-6 space-y-4">
                    
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Keterangan / Deskripsi File</label>
                        <input wire:model="keterangan_file" type="text" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: Laporan LPJ Seminar atau Foto Kegiatan">
                        @error('keterangan_file') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Pilih File (JPG/PNG/PDF, Max 2MB)</label>
                        <input wire:model="file_bukti" type="file" class="block w-full text-sm text-slate-900 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 focus:outline-none p-2.5">
                        
                        <div wire:loading wire:target="file_bukti" class="text-sm text-blue-600 mt-2 font-medium">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Mengunggah file...
                        </div>
                        @error('file_bukti') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 mt-6 border-t border-slate-100">
                        <button type="button" wire:click="closeDokumenModal" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                            <span wire:loading.remove wire:target="uploadDokumen">Simpan File</span>
                            <span wire:loading wire:target="uploadDokumen">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>
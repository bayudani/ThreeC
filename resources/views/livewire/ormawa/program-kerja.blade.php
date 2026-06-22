<div class="space-y-8">
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.300ms class="fixed top-4 right-4 z-50 max-w-sm bg-white rounded-2xl shadow-lg border border-success-100 p-4 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-success-50 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800">Berhasil!</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-8 h-8 bg-blue-600/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Program Kerja</h2>
                    <p class="text-sm text-slate-500">Kelola progres dan unggah bukti laporan kegiatan ormawa Anda</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="openBuatModal"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Buat Program Kerja
            </button>
            <div class="relative w-64">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full pl-9 p-2.5 transition-all placeholder:text-slate-400" placeholder="Cari program kerja...">
                @if($search)
                    <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Proker</p>
                    <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-0.5">{{ $stats['selesai'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Berjalan</p>
                    <p class="text-2xl font-bold text-amber-600 mt-0.5">{{ $stats['berjalan'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th scope="col" class="px-5 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Program</th>
                        <th scope="col" class="px-5 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Status</th>
                        <th scope="col" class="px-5 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-56">Progress</th>
                        <th scope="col" class="px-5 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center">Bukti</th>
                        <th scope="col" class="px-5 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($prokers as $proker)
                        @php
                            $colors = match($proker->status) {
                                'selesai' => ['dot' => 'bg-emerald-500', 'badge' => 'bg-emerald-50 text-emerald-700 border border-emerald-200', 'bar' => 'bg-emerald-500'],
                                'berjalan' => ['dot' => 'bg-blue-500', 'badge' => 'bg-blue-50 text-blue-700 border border-blue-200', 'bar' => 'bg-blue-500'],
                                default => ['dot' => 'bg-slate-400', 'badge' => 'bg-slate-50 text-slate-600 border border-slate-200', 'bar' => 'bg-slate-400'],
                            };
                            $label = match($proker->status) {
                                'selesai' => 'Selesai',
                                'berjalan' => 'Berjalan',
                                default => 'Belum Dimulai',
                            };
                            $docCount = $proker->dokumentasis->count();
                        @endphp
                        <tr class="bg-white border-b border-slate-100 hover:bg-blue-50/20 transition-colors">
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-800">{{ $proker->nama_proker }}</p>
                                <p class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M Y') }}
                                </p>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-lg {{ $colors['badge'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['dot'] }}"></span>
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="flex-1 max-w-[80px] bg-slate-100 rounded-full h-2 overflow-hidden">
                                        <div class="{{ $colors['bar'] }} h-2 rounded-full transition-all duration-500" style="width: {{ $proker->progress }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700 tabular-nums">{{ $proker->progress }}%</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-center">
                                @if($docCount > 0)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold border border-indigo-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $docCount }} File
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400 italic">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button wire:click="openProgressModal({{ $proker->id }})" class="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Update Progress">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    </button>
                                    <button wire:click="openDokumenModal({{ $proker->id }})" class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Upload Bukti">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    </button>
                                    <a href="{{ route('ormawa.proker.detail', $proker->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-xs font-semibold rounded-lg transition-all shadow-sm">
                                        Kelola
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                        <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    </div>
                                    <p class="text-base font-semibold text-slate-600">Belum ada program kerja</p>
                                    <p class="text-sm text-slate-400 mt-1">Klik tombol "Buat Program Kerja" untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pt-2">
        {{ $prokers->links(data: ['scrollTo' => false]) }}
    </div>

    {{-- Modal Update Progress --}}
    @if($isProgressModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" wire:key="progress-modal">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Update Progress</h3>
                    </div>
                    <button wire:click="closeProgressModal" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="updateProgress" class="p-6 space-y-5">
                    <div>
                        <label class="block mb-3 text-sm font-semibold text-slate-700">
                            Persentase Penyelesaian: <span class="text-blue-600">{{ $progress }}%</span>
                        </label>
                        <input wire:model.live="progress" type="range" min="0" max="100" class="w-full h-2 bg-slate-200 rounded-full appearance-none cursor-pointer accent-blue-600">
                        <div class="flex justify-between text-xs text-slate-400 mt-1.5">
                            <span>0%</span>
                            <span>50%</span>
                            <span>100%</span>
                        </div>
                        @error('progress') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Status Saat Ini</label>
                        <select wire:model="status" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all">
                            <option value="belum_dimulai">Belum Dimulai</option>
                            <option value="berjalan">Sedang Berjalan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="closeProgressModal" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-[0.97] rounded-lg transition-all shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal Upload Dokumen --}}
    @if($isDokumenModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" wire:key="dokumen-modal">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Upload Bukti Laporan</h3>
                    </div>
                    <button wire:click="closeDokumenModal" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="uploadDokumen" class="p-6 space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Keterangan / Deskripsi File</label>
                        <input wire:model="keterangan_file" type="text" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Contoh: Laporan LPJ Seminar">
                        @error('keterangan_file') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Pilih File</label>
                        <div class="relative border-2 border-dashed border-slate-200 rounded-lg p-6 text-center hover:border-blue-300 hover:bg-blue-50/30 transition-all cursor-pointer">
                            <input wire:model="file_bukti" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".jpg,.jpeg,.png,.pdf">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="text-sm text-slate-500">Klik untuk upload <span class="font-semibold text-slate-600">JPG/PNG/PDF</span></p>
                                <p class="text-xs text-slate-400">Maksimal 2MB</p>
                            </div>
                        </div>
                        <div wire:loading wire:target="file_bukti" style="display: none;" class="text-sm text-blue-600 mt-2 font-medium flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Mengunggah file...
                        </div>
                        @error('file_bukti') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="closeDokumenModal" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-[0.97] rounded-lg transition-all shadow-sm flex items-center gap-2">
                            <span wire:loading.remove wire:target="uploadDokumen">Simpan File</span>
                            <span wire:loading wire:target="uploadDokumen" style="display: none;">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal Buat Program Kerja --}}
    @if($isBuatModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" wire:key="buat-modal">
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Buat Program Kerja Baru</h3>
                    </div>
                    <button wire:click="closeBuatModal" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="simpanProker" class="p-6 space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Nama Program <span class="text-red-500">*</span></label>
                        <input wire:model="nama_proker" type="text" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Contoh: Seminar Nasional Teknologi 2026">
                        @error('nama_proker') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Deskripsi Singkat (Opsional)</label>
                        <textarea wire:model="deskripsi" rows="3" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Jelaskan secara singkat tujuan program kerja ini..."></textarea>
                        @error('deskripsi') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Target Pelaksanaan <span class="text-red-500">*</span></label>
                        <input wire:model="target_waktu" type="date" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all">
                        @error('target_waktu') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="closeBuatModal" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-[0.97] rounded-lg transition-all shadow-sm flex items-center gap-2">
                            <span wire:loading.remove wire:target="simpanProker">Simpan Program</span>
                            <span wire:loading wire:target="simpanProker" style="display: none;">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
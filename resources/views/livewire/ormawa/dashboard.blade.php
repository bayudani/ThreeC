<div class="max-w-7xl mx-auto space-y-6">
    
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
            <span class="font-bold">Berhasil!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p class="text-slate-500 mt-1">Akses cepat kendali program kerja dan pemantauan organisasi Anda.</p>
        </div>
        <button wire:click="openModal" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Program Baru
        </button>
    </div>

    <!-- 4 Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        <!-- Card 1 -->
        <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute bottom-0 left-6 right-6 h-1 bg-blue-600 rounded-t-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Program Kerja</p>
            <h3 class="text-4xl font-extrabold text-blue-700 mt-3">{{ $metrics['total'] }}</h3>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute bottom-0 left-6 right-6 h-1 bg-green-500 rounded-t-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Program Selesai</p>
            <div class="flex items-baseline gap-2 mt-3">
                <h3 class="text-4xl font-extrabold text-slate-800">{{ $metrics['selesai'] }}</h3>
                <span class="text-sm font-semibold text-slate-400">/ {{ $metrics['total'] }}</span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute bottom-0 left-6 right-6 h-1 bg-indigo-500 rounded-t-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sedang Berjalan</p>
            <h3 class="text-4xl font-extrabold text-slate-800 mt-3">{{ $metrics['berjalan'] }}</h3>
        </div>

        <!-- Card 4 (Actionable) -->
        <div class="bg-white rounded-xl p-6 border border-red-200 shadow-sm relative overflow-hidden bg-red-50/30">
            <div class="absolute bottom-0 left-6 right-6 h-1 bg-red-500 rounded-t-md"></div>
            <p class="text-xs font-bold text-red-600 uppercase tracking-wider">Laporan Belum Diunggah</p>
            <h3 class="text-4xl font-extrabold text-red-600 mt-3">{{ $metrics['tertunda'] }}</h3>
        </div>
    </div>

    <!-- Main Content Layout: 2 Columns -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        
        <!-- Left: Proker Terkini (span 2) -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Program Kerja Terkini</h3>
                <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">Lihat Semua</a>
            </div>
            
            <div class="p-0 flex-1 divide-y divide-slate-100">
                @forelse($prokerTerkini as $proker)
                    @php
                        $colorClass = match($proker->status) {
                            'selesai' => 'bg-green-500',
                            'berjalan' => 'bg-blue-600',
                            default => 'bg-slate-300',
                        };
                        $badgeClass = match($proker->status) {
                            'selesai' => 'bg-green-50 text-green-700',
                            'berjalan' => 'bg-blue-50 text-blue-700',
                            default => 'bg-slate-100 text-slate-600',
                        };
                        $statusText = match($proker->status) {
                            'selesai' => 'Selesai',
                            'berjalan' => 'In Progress',
                            default => 'Not Started',
                        };
                    @endphp
                    <!-- Program Item -->
                    <div class="p-6 hover:bg-slate-50 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-bold text-slate-800 text-base">{{ $proker->nama_proker }}</h4>
                            <span class="px-2.5 py-1 text-[11px] font-bold rounded {{ $badgeClass }}">{{ $statusText }}</span>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="w-full bg-slate-100 rounded-full h-2.5 mb-2">
                            <div class="{{ $colorClass }} h-2.5 rounded-full" style="width: {{ $proker->progress }}%"></div>
                        </div>
                        
                        <div class="flex justify-between text-xs font-medium text-slate-500">
                            <span>Progress: {{ $proker->progress }}%</span>
                            <span>Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center flex flex-col items-center justify-center text-slate-500">
                        <svg class="w-12 h-12 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        <p class="font-medium text-slate-600">Belum ada program kerja</p>
                        <p class="text-sm mt-1">Buat program kerja pertama organisasi Anda sekarang.</p>
                        <button class="mt-4 px-4 py-2 bg-blue-50 text-blue-700 font-semibold text-sm rounded-lg hover:bg-blue-100 transition-colors">
                            Buat Program
                        </button>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right: Pengumuman Kampus (span 1) -->
        <div class="bg-slate-50 rounded-xl border border-slate-200 shadow-sm flex flex-col overflow-hidden">
            <div class="p-6 bg-white border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-800">Pengumuman Kampus</h3>
            </div>
            
            <div class="p-5 space-y-4 overflow-y-auto max-h-[500px]">
                
                @forelse($pengumumans as $pengumuman)
                    @php
                        // Styling dinamis berdasarkan tipe pengumuman
                        $borderColor = match($pengumuman->tipe) {
                            'mendesak' => 'border-l-red-500',
                            'info' => 'border-l-blue-500',
                            'kegiatan' => 'border-l-slate-400',
                            default => 'border-l-slate-300',
                        };
                        $textColor = match($pengumuman->tipe) {
                            'mendesak' => 'text-red-600',
                            'info' => 'text-blue-600',
                            'kegiatan' => 'text-slate-600',
                            default => 'text-slate-500',
                        };
                    @endphp
                    <!-- Alert Dynamic -->
                    <div class="bg-white p-4 rounded-lg border-l-4 {{ $borderColor }} shadow-sm">
                        <p class="text-[10px] font-bold {{ $textColor }} tracking-wider uppercase mb-1">{{ $pengumuman->tipe }}</p>
                        <p class="text-sm font-bold text-slate-800 mb-1">{{ $pengumuman->judul }}</p>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $pengumuman->isi }}</p>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-sm text-slate-500">Belum ada pengumuman terbaru.</p>
                    </div>
                @endforelse

            </div>
            
            <div class="mt-auto p-4 flex justify-center border-t border-slate-200/60 bg-white">
                <p class="text-xs font-semibold text-slate-400">Three-C &copy; {{ date('Y') }}</p>
            </div>
        </div>

    </div>

    <!-- MODAL BUAT PROGRAM KERJA BARU -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-slate-900/50 backdrop-blur-sm p-4 md:p-0">
            <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden" 
                 @click.away="$wire.closeModal()">
                
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Buat Program Kerja Baru</h3>
                    <button wire:click="closeModal" class="text-slate-400 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Modal Body (Form) -->
                <form wire:submit.prevent="simpanProker" class="p-6 space-y-4">
                    
                    <div>
                        <label for="nama_proker" class="block mb-2 text-sm font-semibold text-slate-700">Nama Program <span class="text-red-500">*</span></label>
                        <input wire:model="nama_proker" type="text" id="nama_proker" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: Seminar Nasional Teknologi 2026">
                        @error('nama_proker') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block mb-2 text-sm font-semibold text-slate-700">Deskripsi Singkat (Opsional)</label>
                        <textarea wire:model="deskripsi" id="deskripsi" rows="3" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Jelaskan secara singkat tujuan program kerja ini..."></textarea>
                        @error('deskripsi') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="target_waktu" class="block mb-2 text-sm font-semibold text-slate-700">Target Pelaksanaan <span class="text-red-500">*</span></label>
                        <input wire:model="target_waktu" type="date" id="target_waktu" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('target_waktu') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Modal Footer (Actions) -->
                    <div class="flex items-center justify-end gap-3 pt-4 mt-6 border-t border-slate-100">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-colors flex items-center gap-2">
                            <span wire:loading.remove wire:target="simpanProker">Simpan Program</span>
                            <span wire:loading wire:target="simpanProker">Menyimpan...</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif

</div>
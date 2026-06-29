<div class="space-y-8">
    {{-- Success Toast --}}
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.300ms class="fixed top-4 right-4 z-50 max-w-sm bg-white rounded-2xl shadow-lg border border-emerald-100 p-4 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
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

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-8 h-8 bg-blue-600/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Program Kerja</h2>
                    <p class="text-sm text-slate-500">Pemantauan dan validasi program kerja seluruh ormawa</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Berjalan</p>
                    <p class="text-2xl font-bold text-blue-600 mt-0.5">{{ $stats['berjalan'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Menunggu Validasi</p>
                    <p class="text-2xl font-bold text-amber-600 mt-0.5">{{ $stats['tertunda'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Ditolak</p>
                    <p class="text-2xl font-bold text-red-600 mt-0.5">{{ $stats['ditolak'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-white/80 uppercase tracking-wider">Success Rate</p>
                    <p class="text-2xl font-bold text-white mt-0.5">{{ $stats['successRate'] }}%</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full pl-10 p-2.5 transition-all" placeholder="Cari nama proker atau ormawa...">
                @if($search)
                    <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                @endif
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-xs font-medium text-slate-500 mr-1">Status:</span>
                <button wire:click="setStatus('')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === '' ? 'bg-slate-800 border-slate-800 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Semua
                </button>
                <button wire:click="setStatus('menunggu_validasi')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === 'menunggu_validasi' ? 'bg-amber-500 border-amber-500 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Menunggu
                </button>
                <button wire:click="setStatus('berjalan')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === 'berjalan' ? 'bg-blue-600 border-blue-600 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Berjalan
                </button>
                <button wire:click="setStatus('selesai')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === 'selesai' ? 'bg-emerald-600 border-emerald-600 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Selesai
                </button>
                <button wire:click="setStatus('ditolak')" class="px-3.5 py-2 text-xs font-semibold rounded-xl border transition-all duration-150 {{ $filterStatus === 'ditolak' ? 'bg-red-600 border-red-600 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Ditolak
                </button>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-[30%]">Nama Program</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Ormawa</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-56">Progress</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($prokers as $proker)
                        @php
                            $isPendingProker = $proker->isPending();
                            $isRejectedProker = $proker->isRejected();
                            if ($isPendingProker) {
                                $colors = ['dot' => 'bg-amber-500', 'badge' => 'bg-amber-50 text-amber-700 border border-amber-200', 'bar' => 'bg-slate-400'];
                                $label = 'Menunggu Validasi';
                            } elseif ($isRejectedProker) {
                                $colors = ['dot' => 'bg-red-500', 'badge' => 'bg-red-50 text-red-700 border border-red-200', 'bar' => 'bg-slate-400'];
                                $label = 'Ditolak';
                            } else {
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
                            }
                        @endphp
                        <tr wire:key="proker-{{ $proker->id }}" class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ $proker->nama_proker }}</p>
                                <p class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Target: {{ \Carbon\Carbon::parse($proker->target_waktu)->translatedFormat('d M Y') }}
                                </p>
                                @if($isRejectedProker && $proker->rejection_reason)
                                    <p class="text-xs text-red-500 mt-1">{{ $proker->rejection_reason }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-[10px] font-bold shrink-0">
                                        {{ substr($proker->ormawa->nama ?? '?', 0, 1) }}
                                    </div>
                                    <span class="font-medium text-slate-700">{{ $proker->ormawa->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-bold rounded-lg {{ $colors['badge'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['dot'] }}"></span>
                                    {{ $label }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 bg-slate-100 rounded-full h-2 overflow-hidden">
                                        <div class="{{ $colors['bar'] }} h-2 rounded-full transition-all duration-500" style="width: {{ $proker->progress }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700 min-w-[2.5rem] text-right tabular-nums">{{ $proker->progress }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if($isPendingProker)
                                        <button wire:click="approveProker({{ $proker->id }})" class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold rounded-lg transition-all" title="Setujui">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            Setujui
                                        </button>
                                        <button wire:click="openRejectModal({{ $proker->id }})" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-all" title="Tolak">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Tolak
                                        </button>
                                    @elseif($isRejectedProker)
                                        <span class="text-xs text-red-500 font-medium">Ditolak</span>
                                    @else
                                        <a href="{{ route('admin.proker.detail', $proker->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 text-xs font-semibold rounded-xl border border-slate-200 hover:border-blue-200 transition-all duration-150">
                                            Detail
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="max-w-xs mx-auto">
                                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    </div>
                                    <h4 class="text-base font-semibold text-slate-700 mb-1">Tidak ada data</h4>
                                    <p class="text-sm text-slate-400 leading-relaxed">Tidak ada program kerja dengan filter ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($prokers->hasPages())
        <div class="pt-2">
            {{ $prokers->links(data: ['scrollTo' => false]) }}
        </div>
    @endif

    {{-- Modal Reject --}}
    @if($showRejectModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" wire:key="reject-modal">
            <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Tolak Program Kerja</h3>
                    </div>
                    <button wire:click="closeRejectModal" class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="rejectProker" class="p-6 space-y-5">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Alasan Penolakan</label>
                        <textarea wire:model="rejection_reason" rows="3" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-red-500/20 focus:border-red-500 block w-full p-2.5 transition-all" placeholder="Jelaskan alasan mengapa program kerja ini ditolak..."></textarea>
                        @error('rejection_reason') <span class="text-red-500 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="closeRejectModal" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 active:scale-[0.97] rounded-lg transition-all shadow-sm">
                            Tolak Program
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
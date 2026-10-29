<div>
    {{-- Success Toast --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.300ms class="fixed top-4 right-4 z-50 max-w-sm bg-white rounded-2xl shadow-lg border border-emerald-100 p-4 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800">Berhasil!</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kontak Admin</h1>
            <p class="text-sm text-slate-500 mt-1">Isi semua kontak sekaligus. Kosongkan field jika kontak tidak digunakan. Tampil otomatis di footer dan dashboard ormawa.</p>
        </div>
    </div>

    {{-- Form Kontak --}}
    <form wire:submit="save" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="text-sm font-bold text-slate-700">Kontak Kemahasiswaan (Mendagri)</h2>
        </div>

        <div class="p-6 space-y-5">
            {{-- Email --}}
            <div>
                <label for="kontak_email" class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-1.5">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Email
                </label>
                <input id="kontak_email" wire:model="email" type="email" placeholder="admin@unsera.ac.id" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm px-3 py-2.5">
                <p class="text-xs text-slate-400 mt-1">Link otomatis: <span class="font-mono">mailto:</span></p>
                @error('email') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- WhatsApp --}}
            <div>
                <label for="kontak_wa" class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-1.5">
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
                    WhatsApp
                </label>
                <input id="kontak_wa" wire:model="whatsapp" type="text" placeholder="08123456789" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm px-3 py-2.5">
                <p class="text-xs text-slate-400 mt-1">Link otomatis: <span class="font-mono">wa.me/nomor</span></p>
                @error('whatsapp') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Instagram --}}
            <div>
                <label for="kontak_ig" class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-1.5">
                    <svg class="w-4 h-4 text-rose-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
                    Instagram
                </label>
                <input id="kontak_ig" wire:model="instagram" type="text" placeholder="bem_unsera" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 text-sm px-3 py-2.5">
                <p class="text-xs text-slate-400 mt-1">Username tanpa <span class="font-mono">@</span>. Link otomatis: <span class="font-mono">instagram.com/username</span></p>
                @error('instagram') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- TikTok --}}
            <div>
                <label for="kontak_tt" class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-1.5">
                    <svg class="w-4 h-4 text-slate-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"></path></svg>
                    TikTok
                </label>
                <input id="kontak_tt" wire:model="tiktok" type="text" placeholder="bem_unsera" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-slate-500/20 focus:border-slate-500 text-sm px-3 py-2.5">
                <p class="text-xs text-slate-400 mt-1">Username tanpa <span class="font-mono">@</span>. Link otomatis: <span class="font-mono">tiktok.com/@username</span></p>
                @error('tiktok') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Telepon --}}
            <div>
                <label for="kontak_telp" class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-1.5">
                    <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    Telepon
                </label>
                <input id="kontak_telp" wire:model="telepon" type="text" placeholder="0254-123456" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 text-sm px-3 py-2.5">
                <p class="text-xs text-slate-400 mt-1">Link otomatis: <span class="font-mono">tel:</span></p>
                @error('telepon') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            {{-- Website --}}
            <div>
                <label for="kontak_web" class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-1.5">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    Website
                </label>
                <input id="kontak_web" wire:model="website" type="url" placeholder="https://unsera.ac.id" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 text-sm px-3 py-2.5">
                <p class="text-xs text-slate-400 mt-1">Link otomatis: buka langsung URL</p>
                @error('website') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end">
            <button type="submit" wire:loading.attr="disabled" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm disabled:opacity-50 inline-flex items-center gap-2">
                <svg wire:loading wire:target="save" style="display: none;" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span wire:loading.remove wire:target="save">Simpan Semua Kontak</span>
                <span wire:loading wire:target="save" style="display: none;">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>

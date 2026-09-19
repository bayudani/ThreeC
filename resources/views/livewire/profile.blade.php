<div class="max-w-5xl mx-auto space-y-8">
    @php
        $user = Auth::user();
        $isAdmin = $user->role === 'admin_kampus';
        $roleLabel = $isAdmin ? 'Admin Kampus' : 'Admin Ormawa';
        $initial = strtoupper(substr($user->name, 0, 1));
    @endphp

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
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    {{-- Header Profil --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
        <div class="p-6 sm:p-7 flex flex-col sm:flex-row sm:items-center gap-5">
            <div class="relative shrink-0">
                <div class="w-20 h-20 rounded-2xl bg-blue-600 flex items-center justify-center">
                    <span class="text-2xl font-bold text-white">{{ $initial }}</span>
                </div>
                <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-white flex items-center justify-center {{ $isAdmin ? 'bg-slate-700' : 'bg-blue-600' }}">
                    <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2.5">
                    <h1 class="text-lg font-bold text-slate-900">{{ $user->name }}</h1>
                    <span class="inline-flex items-center px-2 py-0.5 text-[11px] font-semibold rounded-md border {{ $isAdmin ? 'bg-slate-100 text-slate-700 border-slate-200' : 'bg-blue-50 text-blue-700 border-blue-200' }}">
                        {{ $roleLabel }}
                    </span>
                </div>
                <p class="text-sm text-slate-500 mt-1.5">
                    <span class="font-mono text-slate-600">{{ $user->username }}</span>
                    @if($user->email)
                        <span class="mx-1.5 text-slate-300">·</span>
                        <span>{{ $user->email }}</span>
                    @endif
                </p>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1.5 text-xs text-slate-400">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        Terdaftar {{ $user->created_at->format('d M Y') }}
                    </span>
                    @if($user->ormawa)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            {{ $user->ormawa->nama }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 2-Column Grid: Informasi Akun & Keamanan --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Profil Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                <div class="w-8 h-8 bg-blue-50 border border-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Informasi Akun</h2>
                    <p class="text-xs text-slate-400">Data identitas yang terhubung dengan login Anda</p>
                </div>
            </div>
            <form wire:submit="updateProfile" class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Lengkap</label>
                    <input wire:model="name" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Nama lengkap Anda">
                    @error('name') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Username</label>
                    <input wire:model="username" type="text" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Username">
                    <p class="text-xs text-slate-400 mt-1.5">Username dipakai untuk login ke sistem.</p>
                    @error('username') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                    <input wire:model="email" type="email" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="email@example.com">
                    @error('email') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm disabled:opacity-50">
                        <svg wire:loading wire:target="updateProfile" style="display: none;" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
                        <span wire:loading wire:target="updateProfile" style="display: none;">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Keamanan --}}
        @if($isAdmin)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                    <div class="w-8 h-8 bg-amber-50 border border-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Ganti Password</h2>
                        <p class="text-xs text-slate-400">Gunakan minimal 8 karakter</p>
                    </div>
                </div>
                <form wire:submit="updatePassword" class="px-6 py-5 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Password Saat Ini</label>
                        <input wire:model="current_password" type="password" autocomplete="current-password" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Masukkan password saat ini">
                        @error('current_password') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Password Baru</label>
                        <div class="relative">
                            <input wire:model="new_password" :type="show ? 'text' : 'password'" autocomplete="new-password" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 pr-10 transition-all" placeholder="Minimal 8 karakter">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                        @error('new_password') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-medium text-slate-600 mb-1.5">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input wire:model="new_password_confirmation" :type="show ? 'text' : 'password'" autocomplete="new-password" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 pr-10 transition-all" placeholder="Ulangi password baru">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                        @error('new_password_confirmation') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="pt-2">
                        <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm disabled:opacity-50">
                            <svg wire:loading wire:target="updatePassword" style="display: none;" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            <span wire:loading.remove wire:target="updatePassword">Ganti Password</span>
                            <span wire:loading wire:target="updatePassword" style="display: none;">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                    <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-slate-800">Keamanan Akun</h2>
                        <p class="text-xs text-slate-400">Password dikelola oleh Admin Kampus</p>
                    </div>
                </div>
                <div class="px-6 py-6">
                    <div class="flex items-start gap-3.5 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Password akun Anda diatur oleh Admin Kampus</p>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Untuk keamanan, password akun ormawa tidak dapat diganti sendiri. Hubungi Admin Kampus jika ingin mengubahnya.
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2 text-xs text-slate-400">
                        <kbd class="px-2 py-1 bg-slate-100 border border-slate-200 rounded-md font-mono text-slate-600">{{ $user->username }}</kbd>
                        <span>adalah username login Anda</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
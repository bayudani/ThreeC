<div>
    @if(session('error'))
    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
        {{ session('error') }}
    </div>
    @endif

    <form wire:submit="authenticate" class="space-y-5">
        <div>
            <label for="login_id" class="block text-sm font-semibold text-slate-700 mb-1.5">
                Nama Ormawa / Email / Username
            </label>
            <input wire:model="login_id" id="login_id" type="text" autofocus autocomplete="username" placeholder="cth: himatif atau admin@unsera.ac.id"
                class="w-full rounded-lg border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder:text-slate-300 @error('login_id') border-red-300 @enderror">
            @error('login_id')
            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div x-data="{ showPassword: false }">
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <div class="relative">
                <input wire:model="password" id="password" :type="showPassword ? 'text' : 'password'" autocomplete="current-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                    class="w-full rounded-lg border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder:text-slate-300 @error('password') border-red-300 @enderror pr-10">
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @error('password')
            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-lg transition-all shadow-md shadow-blue-200">
            Masuk
        </button>
    </form>

    <div class="mt-5 sm:mt-6 pt-4 sm:pt-5 border-t border-slate-100">
        <p class="text-[11px] sm:text-xs text-slate-400 text-center leading-relaxed">
            <strong class="text-slate-500">Admin Ormawa:</strong> Login menggunakan <span class="font-semibold text-slate-600">nama ormawa</span> (cth: <kbd class="px-1.5 py-0.5 bg-slate-100 rounded text-[10px] font-mono">himatif</kbd>)<br>
            <strong class="text-slate-500">Admin Kampus:</strong> Login menggunakan <span class="font-semibold text-slate-600">email</span> (cth: <kbd class="px-1.5 py-0.5 bg-slate-100 rounded text-[10px] font-mono">admin@unsera.ac.id</kbd>)
        </p>
    </div>
</div>

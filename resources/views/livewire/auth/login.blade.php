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

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
            <input wire:model="password" id="password" type="password" autocomplete="current-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                class="w-full rounded-lg border border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder:text-slate-300 @error('password') border-red-300 @enderror">
            @error('password')
            <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-lg transition-all shadow-md shadow-blue-200">
            Masuk
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-slate-100">
        <p class="text-xs text-slate-400 text-center leading-relaxed">
            <strong class="text-slate-500">Admin Ormawa:</strong> Login menggunakan <span class="font-semibold text-slate-600">nama ormawa</span> sebagai username (cth: <kbd class="px-1.5 py-0.5 bg-slate-100 rounded text-[10px] font-mono">himatif</kbd>)<br>
            <strong class="text-slate-500">Admin Kampus:</strong> Login menggunakan <span class="font-semibold text-slate-600">email</span> (cth: <kbd class="px-1.5 py-0.5 bg-slate-100 rounded text-[10px] font-mono">admin@unsera.ac.id</kbd>)
        </p>
    </div>
</div>

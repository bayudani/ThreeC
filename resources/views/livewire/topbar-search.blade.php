<div class="relative w-full max-w-md hidden md:block" x-data="{ open: @entangle('showDropdown') }" @click.outside="open = false">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div>
    <input
        type="text"
        wire:model.live="query"
        @focus="open = true"
        autocomplete="off"
        class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
        placeholder="Cari program kerja atau ormawa..."
    >

    @if($showDropdown && count($results) > 0)
        <div class="absolute top-full left-0 right-0 mt-1 bg-white border border-slate-200 rounded-lg shadow-lg overflow-hidden z-50">
            @foreach($results as $result)
                <button
                    wire:click="selectResult('{{ $result['url'] }}')"
                    class="w-full flex items-center gap-3 px-4 py-3 text-left hover:bg-slate-50 transition-colors border-b border-slate-100 last:border-0"
                >
                    <span class="shrink-0 px-2 py-0.5 text-[10px] font-bold rounded {{ $result['type'] === 'Ormawa' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }}">
                        {{ $result['type'] }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $result['label'] }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ $result['sub'] }}</p>
                    </div>
                </button>
            @endforeach
        </div>
    @endif
</div>

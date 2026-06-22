@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-slate-500">
                <span class="font-medium text-slate-700">{{ $paginator->firstItem() }}</span>
                <span class="mx-1">—</span>
                <span class="font-medium text-slate-700">{{ $paginator->lastItem() }}</span>
                <span class="mx-1">dari</span>
                <span class="font-medium text-slate-700">{{ $paginator->total() }}</span>
                <span class="ml-1">data</span>
            </div>

            <div class="flex items-center gap-1.5">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="flex items-center justify-center w-9 h-9 rounded-xl text-sm text-slate-300 border border-slate-200 cursor-default" aria-hidden="true">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </span>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="flex items-center justify-center w-9 h-9 rounded-xl text-sm font-medium text-slate-600 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 active:bg-slate-100 transition-all" aria-label="Sebelumnya">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="flex items-center justify-center w-9 h-9 text-sm text-slate-400 select-none">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="flex items-center justify-center w-9 h-9 rounded-xl text-sm font-bold text-white bg-blue-600 shadow-sm shadow-blue-200">{{ $page }}</span>
                                    </span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="flex items-center justify-center w-9 h-9 rounded-xl text-sm font-medium text-slate-600 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 active:bg-slate-100 transition-all" aria-label="Ke halaman {{ $page }}">
                                        {{ $page }}
                                    </button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="flex items-center justify-center w-9 h-9 rounded-xl text-sm font-medium text-slate-600 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 active:bg-slate-100 transition-all" aria-label="Selanjutnya">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                @else
                    <span class="flex items-center justify-center w-9 h-9 rounded-xl text-sm text-slate-300 border border-slate-200 cursor-default" aria-hidden="true">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                @endif
            </div>
        </nav>
    @endif
</div>
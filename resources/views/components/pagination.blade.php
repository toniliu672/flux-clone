@props([
    'currentPage' => 1,
    'lastPage' => 1,
    'total' => 0,
    'perPage' => 10,
    'simple' => false,
])

@php
    $from = ($currentPage - 1) * $perPage + 1;
    $to = min($currentPage * $perPage, $total);
@endphp

<nav {{ $attributes->class(['flex items-center justify-between']) }} aria-label="Pagination">
    {{-- Results summary --}}
    <div class="hidden sm:block">
        <p class="text-sm text-zinc-500 dark:text-zinc-400">
            Showing <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $from }}</span>
            to <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $to }}</span>
            of <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $total }}</span> results
        </p>
    </div>

    {{-- Navigation --}}
    <div class="flex flex-1 justify-between sm:justify-end gap-2">
        {{-- Previous --}}
        <button
            type="button"
            @if($currentPage <= 1) disabled @endif
            wire:click="previousPage"
            class="relative inline-flex items-center gap-1 rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50 disabled:opacity-50 disabled:cursor-not-allowed dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800"
        >
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Previous
        </button>

        @if(!$simple)
            {{-- Page numbers --}}
            <div class="hidden sm:flex items-center gap-1">
                @for($page = max(1, $currentPage - 2); $page <= min($lastPage, $currentPage + 2); $page++)
                    <button
                        type="button"
                        wire:click="gotoPage({{ $page }})"
                        @class([
                            'relative inline-flex items-center justify-center size-10 rounded-lg text-sm font-medium transition-colors',
                            'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900' => $page === $currentPage,
                            'text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800' => $page !== $currentPage,
                        ])
                    >
                        {{ $page }}
                    </button>
                @endfor
            </div>
        @endif

        {{-- Next --}}
        <button
            type="button"
            @if($currentPage >= $lastPage) disabled @endif
            wire:click="nextPage"
            class="relative inline-flex items-center gap-1 rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50 disabled:opacity-50 disabled:cursor-not-allowed dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800"
        >
            Next
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </div>
</nav>

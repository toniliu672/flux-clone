@props([
    'searchPlaceholder' => 'Search...',
    'searchable' => true,
    'selectable' => false,
    'paginated' => true,
    'perPage' => 10,
    'perPageOptions' => [10, 25, 50, 100],
    'emptyIcon' => 'inbox',
    'emptyHeading' => 'No data found',
    'emptyDescription' => null,
])

<div 
    {{ $attributes->class(['flux-clone-data-table']) }}
    x-data="{
        search: '',
        sortBy: null,
        sortDirection: 'asc',
        selectedAll: false,
        selected: [],
        filters: {},
        perPage: {{ $perPage }},
        loading: false,

        init() {
            this.$watch('selectedAll', (value) => {
                if (value) {
                    this.selectAll();
                } else {
                    this.selected = [];
                }
            });
        },

        sort(column) {
            if (this.sortBy === column) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortBy = column;
                this.sortDirection = 'asc';
            }
            this.$dispatch('sort', { column: this.sortBy, direction: this.sortDirection });
        },

        toggleSelect(id) {
            if (this.selected.includes(id)) {
                this.selected = this.selected.filter(i => i !== id);
            } else {
                this.selected.push(id);
            }
            this.selectedAll = false;
        },

        selectAll() {
            this.$dispatch('select-all');
        },

        isSelected(id) {
            return this.selected.includes(id);
        },

        clearSelection() {
            this.selected = [];
            this.selectedAll = false;
        },

        hasSelection() {
            return this.selected.length > 0;
        },

        setFilter(name, value) {
            this.filters[name] = value;
            this.$dispatch('filter', { filters: this.filters });
        },

        clearFilters() {
            this.filters = {};
            this.$dispatch('filter', { filters: {} });
        },

        doSearch() {
            this.$dispatch('search', { query: this.search });
        }
    }"
    @keydown.enter.prevent="doSearch()"
>
    {{-- Header: Search & Filters --}}
    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        {{-- Left side: Search --}}
        @if($searchable)
            <div class="relative flex-1 max-w-md">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-flux-clone::icon name="magnifying-glass" class="size-5 text-zinc-400" />
                </div>
                <input
                    type="text"
                    x-model.debounce.300ms="search"
                    @input.debounce.300ms="doSearch()"
                    placeholder="{{ $searchPlaceholder }}"
                    class="block w-full rounded-lg border border-zinc-300 bg-white py-2 pl-10 pr-3 text-sm placeholder:text-zinc-400 focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                />
                <button
                    x-show="search.length > 0"
                    x-on:click="search = ''; doSearch()"
                    type="button"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 hover:text-zinc-600"
                >
                    <x-flux-clone::icon name="x-mark" class="size-4" />
                </button>
            </div>
        @endif

        {{-- Right side: Filters & Actions --}}
        <div class="flex items-center gap-2">
            @if(isset($filters))
                {{ $filters }}
            @endif

            @if(isset($headerActions))
                {{ $headerActions }}
            @endif
        </div>
    </div>

    {{-- Bulk Actions Bar --}}
    @if($selectable)
        <div 
            x-show="hasSelection()"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-4 flex items-center justify-between rounded-lg bg-zinc-100 px-4 py-2 dark:bg-zinc-800"
        >
            <span class="text-sm text-zinc-700 dark:text-zinc-300">
                <span x-text="selected.length"></span> item(s) selected
            </span>
            <div class="flex items-center gap-2">
                @if(isset($bulkActions))
                    {{ $bulkActions }}
                @endif
                <button 
                    x-on:click="clearSelection()"
                    type="button"
                    class="text-sm text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200"
                >
                    Clear selection
                </button>
            </div>
        </div>
    @endif

    {{-- Table --}}
    <div class="relative overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
        {{-- Loading Overlay --}}
        <div 
            x-show="loading"
            x-transition.opacity
            class="absolute inset-0 z-10 flex items-center justify-center bg-white/80 dark:bg-zinc-900/80"
        >
            <svg class="size-8 animate-spin text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                {{-- Header --}}
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        @if($selectable)
                            <th class="w-12 px-4 py-3">
                                <input
                                    type="checkbox"
                                    x-model="selectedAll"
                                    class="size-4 rounded border-zinc-300 text-zinc-900 focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-600 dark:bg-zinc-900"
                                />
                            </th>
                        @endif
                        {{ $head }}
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-zinc-200 bg-white dark:divide-zinc-700 dark:bg-zinc-900">
                    {{ $body }}
                </tbody>
            </table>
        </div>

        {{-- Empty State --}}
        @if(isset($empty))
            {{ $empty }}
        @else
            <div 
                class="hidden [:has(tbody:empty)>&]:flex flex-col items-center justify-center py-12 px-4 text-center"
            >
                @if($emptyIcon)
                    <div class="mb-4 rounded-full bg-zinc-100 p-3 dark:bg-zinc-800">
                        <x-flux-clone::icon :name="$emptyIcon" class="size-8 text-zinc-400 dark:text-zinc-500" />
                    </div>
                @endif
                <h3 class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                    {{ $emptyHeading }}
                </h3>
                @if($emptyDescription)
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        {{ $emptyDescription }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    {{-- Footer: Pagination --}}
    @if($paginated && isset($pagination))
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-2">
                <span class="text-sm text-zinc-500 dark:text-zinc-400">Show</span>
                <select
                    x-model="perPage"
                    @change="$dispatch('per-page', { value: perPage })"
                    class="rounded-lg border border-zinc-300 bg-white px-2 py-1 text-sm focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
                >
                    @foreach($perPageOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                <span class="text-sm text-zinc-500 dark:text-zinc-400">entries</span>
            </div>
            
            <div>
                {{ $pagination }}
            </div>
        </div>
    @endif
</div>

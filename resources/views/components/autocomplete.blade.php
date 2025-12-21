@props([
    'options' => [],
    'placeholder' => 'Type to search...',
    'multiple' => false,
])

<div
    x-data="{
        open: false,
        search: '',
        options: {{ json_encode($options) }},
        selected: {{ $multiple ? '[]' : 'null' }},
        get filteredOptions() {
            if (!this.search) return this.options;
            return this.options.filter(opt => 
                opt.label.toLowerCase().includes(this.search.toLowerCase())
            );
        },
        select(option) {
            @if($multiple)
                if (!this.selected.find(s => s.value === option.value)) {
                    this.selected.push(option);
                }
            @else
                this.selected = option;
                this.search = option.label;
                this.open = false;
            @endif
            this.$dispatch('selected', { value: this.selected });
        },
        remove(index) {
            this.selected.splice(index, 1);
        },
        isSelected(option) {
            @if($multiple)
                return this.selected.some(s => s.value === option.value);
            @else
                return this.selected?.value === option.value;
            @endif
        }
    }"
    {{ $attributes->class(['relative']) }}
>
    {{-- Input --}}
    <div class="relative">
        @if($multiple)
            <div class="flex flex-wrap gap-1 rounded-lg border border-zinc-300 bg-white p-2 dark:border-zinc-600 dark:bg-zinc-900">
                <template x-for="(item, index) in selected" :key="item.value">
                    <span class="inline-flex items-center gap-1 rounded-md bg-zinc-100 px-2 py-1 text-sm dark:bg-zinc-800">
                        <span x-text="item.label"></span>
                        <button type="button" x-on:click="remove(index)" class="text-zinc-400 hover:text-zinc-600">
                            <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </span>
                </template>
                <input
                    type="text"
                    x-model="search"
                    x-on:focus="open = true"
                    x-on:input="open = true"
                    placeholder="{{ $placeholder }}"
                    class="flex-1 min-w-32 border-0 bg-transparent p-0 text-sm focus:outline-none focus:ring-0"
                />
            </div>
        @else
            <input
                type="text"
                x-model="search"
                x-on:focus="open = true"
                x-on:input="open = true; selected = null"
                placeholder="{{ $placeholder }}"
                class="w-full rounded-lg border border-zinc-300 bg-white px-4 py-2 text-sm focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
            />
        @endif
    </div>

    {{-- Dropdown --}}
    <div
        x-show="open && filteredOptions.length > 0"
        x-on:click.outside="open = false"
        x-transition
        class="absolute z-50 mt-1 w-full rounded-lg border border-zinc-200 bg-white shadow-lg dark:border-zinc-700 dark:bg-zinc-900"
        x-cloak
    >
        <ul class="max-h-60 overflow-auto py-1">
            <template x-for="option in filteredOptions" :key="option.value">
                <li
                    x-on:click="select(option)"
                    :class="{ 'bg-zinc-100 dark:bg-zinc-800': isSelected(option) }"
                    class="cursor-pointer px-4 py-2 text-sm text-zinc-900 hover:bg-zinc-50 dark:text-zinc-100 dark:hover:bg-zinc-800"
                >
                    <span x-text="option.label"></span>
                </li>
            </template>
        </ul>
    </div>
</div>

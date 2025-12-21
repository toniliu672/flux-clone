@props([
    'placeholder' => 'Type a command or search...',
])

<div
    x-data="{
        open: false,
        search: '',
        selectedIndex: 0,
        items: [],
        
        init() {
            window.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    this.toggle();
                }
            });
        },
        
        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.search = '';
                this.selectedIndex = 0;
                this.$nextTick(() => this.$refs.input.focus());
            }
        },
        
        close() {
            this.open = false;
        },
        
        next() {
            if (this.selectedIndex < this.items.length - 1) {
                this.selectedIndex++;
            }
        },
        
        prev() {
            if (this.selectedIndex > 0) {
                this.selectedIndex--;
            }
        },
        
        select() {
            if (this.items[this.selectedIndex]) {
                this.$dispatch('command-selected', { item: this.items[this.selectedIndex] });
                this.close();
            }
        }
    }"
    x-on:keydown.escape.window="close()"
    {{ $attributes }}
>
    {{-- Backdrop --}}
    <div
        x-show="open"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 bg-zinc-900/50 backdrop-blur-sm"
        x-on:click="close()"
        x-cloak
    ></div>

    {{-- Dialog --}}
    <div
        x-show="open"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed left-1/2 top-24 z-50 w-full max-w-lg -translate-x-1/2 rounded-xl border border-zinc-200 bg-white shadow-2xl dark:border-zinc-700 dark:bg-zinc-900"
        x-cloak
    >
        {{-- Search Input --}}
        <div class="flex items-center border-b border-zinc-200 px-4 dark:border-zinc-700">
            <svg class="size-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input
                type="text"
                x-ref="input"
                x-model="search"
                x-on:keydown.down.prevent="next()"
                x-on:keydown.up.prevent="prev()"
                x-on:keydown.enter="select()"
                placeholder="{{ $placeholder }}"
                class="flex-1 border-0 bg-transparent py-4 pl-3 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-0 dark:text-zinc-100"
            />
            <kbd class="hidden sm:inline-flex items-center gap-1 rounded border border-zinc-200 bg-zinc-100 px-1.5 py-0.5 text-xs text-zinc-500 dark:border-zinc-700 dark:bg-zinc-800">
                ESC
            </kbd>
        </div>

        {{-- Results --}}
        <div class="max-h-80 overflow-y-auto p-2">
            {{ $slot }}
        </div>

        {{-- Footer --}}
        <div class="flex items-center justify-between border-t border-zinc-200 px-4 py-2 text-xs text-zinc-400 dark:border-zinc-700">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    <kbd class="rounded border border-zinc-200 bg-zinc-100 px-1 dark:border-zinc-700 dark:bg-zinc-800">↑</kbd>
                    <kbd class="rounded border border-zinc-200 bg-zinc-100 px-1 dark:border-zinc-700 dark:bg-zinc-800">↓</kbd>
                    to navigate
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="rounded border border-zinc-200 bg-zinc-100 px-1 dark:border-zinc-700 dark:bg-zinc-800">↵</kbd>
                    to select
                </span>
            </div>
        </div>
    </div>
</div>

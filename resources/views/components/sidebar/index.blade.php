@props([
    'collapsible' => true,
    'collapsed' => false,
])

<aside
    x-data="{ collapsed: {{ $collapsed ? 'true' : 'false' }} }"
    {{ $attributes->class([
        'flex flex-col border-r border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900 transition-all duration-300',
    ]) }}
    :class="collapsed ? 'w-16' : 'w-64'"
>
    {{-- Header --}}
    @if(isset($header))
        <div class="flex items-center justify-between border-b border-zinc-200 p-4 dark:border-zinc-700">
            <div x-show="!collapsed">
                {{ $header }}
            </div>
            @if($collapsible)
                <button
                    type="button"
                    x-on:click="collapsed = !collapsed"
                    class="p-1.5 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-500"
                >
                    <svg 
                        class="size-5 transition-transform" 
                        :class="{ 'rotate-180': collapsed }"
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
            @endif
        </div>
    @endif

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto p-2">
        {{ $slot }}
    </nav>

    {{-- Footer --}}
    @if(isset($footer))
        <div class="border-t border-zinc-200 p-4 dark:border-zinc-700">
            {{ $footer }}
        </div>
    @endif
</aside>

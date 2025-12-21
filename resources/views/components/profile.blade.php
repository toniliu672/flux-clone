@props([
    'avatar' => null,
    'name' => null,
    'email' => null,
])

<div 
    x-data="{ open: false }"
    {{ $attributes->class(['relative']) }}
>
    {{-- Trigger --}}
    <button
        type="button"
        x-on:click="open = !open"
        class="flex items-center gap-2 rounded-lg p-1.5 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors"
    >
        @if($avatar)
            <img src="{{ $avatar }}" alt="{{ $name }}" class="size-8 rounded-full object-cover" />
        @else
            <div class="size-8 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">
                    {{ $name ? strtoupper(substr($name, 0, 1)) : '?' }}
                </span>
            </div>
        @endif
        
        @if($name)
            <div class="hidden sm:block text-left">
                <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $name }}</p>
                @if($email)
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $email }}</p>
                @endif
            </div>
        @endif
        
        <svg class="size-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    {{-- Dropdown --}}
    <div
        x-show="open"
        x-on:click.outside="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-56 origin-top-right rounded-lg border border-zinc-200 bg-white shadow-lg dark:border-zinc-700 dark:bg-zinc-900"
        x-cloak
    >
        <div class="p-1">
            {{ $slot }}
        </div>
    </div>
</div>

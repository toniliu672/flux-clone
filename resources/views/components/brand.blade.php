@props([
    'href' => '/',
    'logo' => null,
    'name' => null,
])

<a 
    href="{{ $href }}"
    {{ $attributes->class(['flex items-center gap-2']) }}
>
    @if($logo)
        <img src="{{ $logo }}" alt="{{ $name ?? 'Logo' }}" class="h-8 w-auto" />
    @else
        {{ $slot }}
    @endif
    
    @if($name)
        <span class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">
            {{ $name }}
        </span>
    @endif
</a>

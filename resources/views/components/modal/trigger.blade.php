@props([
    'name' => null,
])

<div 
    {{ $attributes }}
    x-data
    @if($name)
        x-on:click="$dispatch('open-modal', '{{ $name }}')"
    @endif
    class="cursor-pointer"
>
    {{ $slot }}
</div>

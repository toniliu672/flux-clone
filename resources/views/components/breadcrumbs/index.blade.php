@props([
    'separator' => null,
])

<nav {{ $attributes->class(['flex']) }} aria-label="Breadcrumb">
    <ol class="flex items-center gap-2">
        {{ $slot }}
    </ol>
</nav>

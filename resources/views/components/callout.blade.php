@props([
    'type' => 'info',
    'icon' => null,
])

@php
    $typeClasses = match ($type) {
        'success' => 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300',
        'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800 dark:bg-yellow-900/20 dark:border-yellow-800 dark:text-yellow-300',
        'danger', 'error' => 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300',
        default => 'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-900/20 dark:border-blue-800 dark:text-blue-300', // info
    };

    $defaultIcon = match ($type) {
        'success' => 'check-circle',
        'warning' => 'exclamation-triangle',
        'danger', 'error' => 'x-circle',
        default => 'information-circle',
    };

    $iconToShow = $icon ?? $defaultIcon;
@endphp

<div {{ $attributes->class([
    'flex gap-3 rounded-lg border p-4',
    $typeClasses,
]) }} role="alert">
    {{-- Icon --}}
    <div class="shrink-0">
        <x-flux-clone::icon :name="$iconToShow" class="size-5" />
    </div>

    {{-- Content --}}
    <div class="flex-1 text-sm">
        {{ $slot }}
    </div>
</div>

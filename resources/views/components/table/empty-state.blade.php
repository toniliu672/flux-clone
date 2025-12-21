@props([
    'icon' => 'inbox',
    'heading' => 'No data',
    'description' => null,
])

<div {{ $attributes->class([
    'flex flex-col items-center justify-center py-12 px-4 text-center',
]) }}>
    @if($icon)
        <div class="mb-4 rounded-full bg-zinc-100 p-3 dark:bg-zinc-800">
            <x-flux-clone::icon :name="$icon" class="size-8 text-zinc-400 dark:text-zinc-500" />
        </div>
    @endif

    @if($heading)
        <h3 class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
            {{ $heading }}
        </h3>
    @endif

    @if($description)
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
            {{ $description }}
        </p>
    @endif

    @if($slot->isNotEmpty())
        <div class="mt-4">
            {{ $slot }}
        </div>
    @endif
</div>

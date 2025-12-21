@props([
    'header' => false,
])

<tr {{ $attributes->class([
    'transition-colors',
    '[table[data-hoverable="true"]_tbody_&]:hover:bg-zinc-50 [table[data-hoverable="true"]_tbody_&]:dark:hover:bg-zinc-800/50',
    '[table[data-striped="true"]_tbody_&]:odd:bg-zinc-50 [table[data-striped="true"]_tbody_&]:dark:odd:bg-zinc-800/30',
]) }}>
    {{ $slot }}
</tr>

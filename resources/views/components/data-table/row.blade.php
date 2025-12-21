@props([
    'id' => null,
])

<tr 
    {{ $attributes->class([
        'transition-colors',
        'hover:bg-zinc-50 dark:hover:bg-zinc-800/50',
    ]) }}
    @if($id)
        :class="{ 'bg-zinc-100 dark:bg-zinc-800': isSelected({{ json_encode($id) }}) }"
    @endif
>
    {{-- Selection Checkbox --}}
    @if($id)
        <template x-if="$root.querySelector('[x-model=selectedAll]')">
            <td class="w-12 px-4 py-4">
                <input
                    type="checkbox"
                    :checked="isSelected({{ json_encode($id) }})"
                    @change="toggleSelect({{ json_encode($id) }})"
                    class="size-4 rounded border-zinc-300 text-zinc-900 focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-600 dark:bg-zinc-900"
                />
            </td>
        </template>
    @endif
    
    {{ $slot }}
</tr>

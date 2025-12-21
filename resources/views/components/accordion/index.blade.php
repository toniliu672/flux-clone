@props([
    'multiple' => false,
    'defaultOpen' => null,
])

<div 
    {{ $attributes->class(['divide-y divide-zinc-200 dark:divide-zinc-700 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden']) }}
    x-data="{ 
        activeItems: {{ $defaultOpen ? '[\'' . $defaultOpen . '\']' : '[]' }},
        multiple: {{ $multiple ? 'true' : 'false' }},
        toggle(name) {
            if (this.multiple) {
                if (this.activeItems.includes(name)) {
                    this.activeItems = this.activeItems.filter(i => i !== name);
                } else {
                    this.activeItems.push(name);
                }
            } else {
                this.activeItems = this.activeItems.includes(name) ? [] : [name];
            }
        },
        isOpen(name) {
            return this.activeItems.includes(name);
        }
    }"
>
    {{ $slot }}
</div>

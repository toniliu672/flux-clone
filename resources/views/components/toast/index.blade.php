@props([
    'position' => 'bottom-right',
])

@php
    $positionClasses = match ($position) {
        'top-left' => 'top-4 left-4',
        'top-center' => 'top-4 left-1/2 -translate-x-1/2',
        'top-right' => 'top-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'bottom-center' => 'bottom-4 left-1/2 -translate-x-1/2',
        default => 'bottom-4 right-4',
    };
@endphp

<div
    x-data="{
        toasts: [],
        add(toast) {
            const id = Date.now();
            this.toasts.push({ id, ...toast });
            if (toast.duration !== 0) {
                setTimeout(() => this.remove(id), toast.duration || 5000);
            }
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }"
    @toast.window="add($event.detail)"
    {{ $attributes->class(['fixed z-50', $positionClasses]) }}
>
    <div class="flex flex-col gap-2">
        <template x-for="toast in toasts" :key="toast.id">
            <div
                x-show="true"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="flex items-start gap-3 w-80 rounded-lg border bg-white p-4 shadow-lg dark:bg-zinc-900"
                :class="{
                    'border-zinc-200 dark:border-zinc-700': toast.type === 'default',
                    'border-green-200 dark:border-green-800': toast.type === 'success',
                    'border-red-200 dark:border-red-800': toast.type === 'error',
                    'border-yellow-200 dark:border-yellow-800': toast.type === 'warning',
                    'border-blue-200 dark:border-blue-800': toast.type === 'info',
                }"
            >
                {{-- Icon --}}
                <div 
                    class="flex-shrink-0"
                    :class="{
                        'text-green-500': toast.type === 'success',
                        'text-red-500': toast.type === 'error',
                        'text-yellow-500': toast.type === 'warning',
                        'text-blue-500': toast.type === 'info',
                        'text-zinc-500': toast.type === 'default',
                    }"
                >
                    <template x-if="toast.type === 'success'">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </template>
                    <template x-if="toast.type === 'info'">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </template>
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <p x-text="toast.title" class="text-sm font-medium text-zinc-900 dark:text-zinc-100"></p>
                    <p x-show="toast.message" x-text="toast.message" class="mt-1 text-sm text-zinc-500 dark:text-zinc-400"></p>
                </div>

                {{-- Close --}}
                <button
                    type="button"
                    @click="remove(toast.id)"
                    class="flex-shrink-0 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300"
                >
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </template>
    </div>
</div>

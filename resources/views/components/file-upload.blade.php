@props([
    'multiple' => false,
    'accept' => null,
    'maxSize' => null,
])

<div
    x-data="{
        files: [],
        isDragging: false,
        handleFiles(fileList) {
            const newFiles = Array.from(fileList);
            @if($multiple)
                this.files = [...this.files, ...newFiles];
            @else
                this.files = newFiles.slice(0, 1);
            @endif
            this.$dispatch('files-selected', { files: this.files });
        },
        removeFile(index) {
            this.files.splice(index, 1);
        },
        formatSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    }"
    {{ $attributes }}
>
    {{-- Drop Zone --}}
    <div
        x-on:dragover.prevent="isDragging = true"
        x-on:dragleave.prevent="isDragging = false"
        x-on:drop.prevent="isDragging = false; handleFiles($event.dataTransfer.files)"
        :class="{ 'border-zinc-500 bg-zinc-50 dark:bg-zinc-800': isDragging }"
        class="relative flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-zinc-300 p-8 transition-colors dark:border-zinc-600"
    >
        <svg class="size-10 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
        </svg>
        
        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
            <label class="cursor-pointer font-medium text-zinc-900 hover:text-zinc-700 dark:text-zinc-100 dark:hover:text-zinc-300">
                Choose files
                <input
                    type="file"
                    class="sr-only"
                    @if($multiple) multiple @endif
                    @if($accept) accept="{{ $accept }}" @endif
                    x-on:change="handleFiles($event.target.files)"
                />
            </label>
            or drag and drop
        </p>
        
        @if($accept || $maxSize)
            <p class="mt-1 text-xs text-zinc-500">
                @if($accept) {{ $accept }} @endif
                @if($maxSize) (max {{ $maxSize }}KB) @endif
            </p>
        @endif
    </div>

    {{-- File List --}}
    <template x-if="files.length > 0">
        <ul class="mt-4 space-y-2">
            <template x-for="(file, index) in files" :key="index">
                <li class="flex items-center justify-between rounded-lg border border-zinc-200 bg-zinc-50 px-4 py-2 dark:border-zinc-700 dark:bg-zinc-800">
                    <div class="flex items-center gap-3">
                        <svg class="size-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <div>
                            <p x-text="file.name" class="text-sm font-medium text-zinc-900 dark:text-zinc-100"></p>
                            <p x-text="formatSize(file.size)" class="text-xs text-zinc-500"></p>
                        </div>
                    </div>
                    <button
                        type="button"
                        x-on:click="removeFile(index)"
                        class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300"
                    >
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </li>
            </template>
        </ul>
    </template>
</div>

@props([
    'length' => 6,
    'type' => 'text',
    'autofocus' => true,
])

<div
    x-data="{
        length: {{ $length }},
        values: Array({{ $length }}).fill(''),
        get otp() {
            return this.values.join('');
        },
        handleInput(index, event) {
            const value = event.target.value;
            if (value.length > 1) {
                // Handle paste
                const chars = value.split('').slice(0, this.length);
                chars.forEach((char, i) => {
                    if (i < this.length) this.values[i] = char;
                });
                const nextIndex = Math.min(chars.length, this.length - 1);
                this.$refs['input' + nextIndex]?.focus();
            } else {
                this.values[index] = value;
                if (value && index < this.length - 1) {
                    this.$refs['input' + (index + 1)]?.focus();
                }
            }
            this.$dispatch('otp-complete', { value: this.otp, complete: this.otp.length === this.length });
        },
        handleKeydown(index, event) {
            if (event.key === 'Backspace' && !this.values[index] && index > 0) {
                this.$refs['input' + (index - 1)]?.focus();
            }
        },
        handlePaste(event) {
            event.preventDefault();
            const paste = event.clipboardData.getData('text').slice(0, this.length);
            paste.split('').forEach((char, i) => {
                if (i < this.length) this.values[i] = char;
            });
            const nextIndex = Math.min(paste.length, this.length - 1);
            this.$refs['input' + nextIndex]?.focus();
        }
    }"
    {{ $attributes->class(['flex gap-2']) }}
>
    @for($i = 0; $i < $length; $i++)
        <input
            type="{{ $type }}"
            x-ref="input{{ $i }}"
            x-model="values[{{ $i }}]"
            @input="handleInput({{ $i }}, $event)"
            @keydown="handleKeydown({{ $i }}, $event)"
            @paste="handlePaste($event)"
            maxlength="1"
            @if($autofocus && $i === 0) autofocus @endif
            class="size-12 rounded-lg border border-zinc-300 bg-white text-center text-lg font-semibold text-zinc-900 focus:border-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-500/20 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100"
        />
    @endfor
</div>

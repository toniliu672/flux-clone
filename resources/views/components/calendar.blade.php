@props([
    'value' => null,
    'min' => null,
    'max' => null,
])

<div
    x-data="{
        currentDate: new Date(),
        selectedDate: {{ $value ? '\'' . $value . '\'' : 'null' }},
        today: new Date(),
        
        get monthName() {
            return this.currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
        },
        
        get daysInMonth() {
            const year = this.currentDate.getFullYear();
            const month = this.currentDate.getMonth();
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();
            
            const days = [];
            // Previous month padding
            for (let i = 0; i < firstDay; i++) {
                days.push({ date: null, disabled: true });
            }
            // Current month days
            for (let i = 1; i <= lastDate; i++) {
                const date = new Date(year, month, i);
                const dateStr = date.toISOString().split('T')[0];
                days.push({ 
                    date: i, 
                    dateStr,
                    isToday: this.isToday(date),
                    isSelected: this.isSelected(dateStr),
                    disabled: false
                });
            }
            return days;
        },
        
        prevMonth() {
            this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
        },
        
        nextMonth() {
            this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
        },
        
        selectDate(day) {
            if (day.disabled) return;
            this.selectedDate = day.dateStr;
            this.$dispatch('date-selected', { date: day.dateStr });
        },
        
        isToday(date) {
            return date.toDateString() === this.today.toDateString();
        },
        
        isSelected(dateStr) {
            return this.selectedDate === dateStr;
        }
    }"
    {{ $attributes->class(['w-72 rounded-lg border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900']) }}
>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <button
            type="button"
            x-on:click="prevMonth()"
            class="p-1 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-600 dark:text-zinc-400"
        >
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>
        <span x-text="monthName" class="text-sm font-semibold text-zinc-900 dark:text-zinc-100"></span>
        <button
            type="button"
            x-on:click="nextMonth()"
            class="p-1 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-600 dark:text-zinc-400"
        >
            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </div>

    {{-- Day Names --}}
    <div class="grid grid-cols-7 gap-1 mb-2">
        <template x-for="day in ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']">
            <div class="text-center text-xs font-medium text-zinc-500 dark:text-zinc-400" x-text="day"></div>
        </template>
    </div>

    {{-- Days Grid --}}
    <div class="grid grid-cols-7 gap-1">
        <template x-for="day in daysInMonth">
            <button
                type="button"
                x-on:click="selectDate(day)"
                :disabled="day.disabled"
                :class="{
                    'bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900': day.isSelected,
                    'bg-zinc-100 dark:bg-zinc-800': day.isToday && !day.isSelected,
                    'hover:bg-zinc-100 dark:hover:bg-zinc-800': !day.isSelected && !day.disabled,
                    'text-zinc-400 cursor-default': day.disabled,
                }"
                class="size-8 rounded-lg text-sm font-medium text-zinc-900 dark:text-zinc-100 transition-colors"
            >
                <span x-text="day.date"></span>
            </button>
        </template>
    </div>
</div>

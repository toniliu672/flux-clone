<?php

declare(strict_types=1);

namespace FluxClone\Components;

use FluxClone\FluxClone;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $variant = 'filled',
        public string $size = 'base',
        public ?string $icon = null,
        public ?string $iconTrailing = null,
        public string $type = 'button',
        public bool $square = false,
        public bool $loading = false,
        public bool $disabled = false,
        public ?string $href = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.button');
    }

    public function classes(): string
    {
        return FluxClone::classes(
            // Base styles
            'inline-flex items-center justify-center gap-2 font-medium transition-all duration-150',
            'focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2',
            'disabled:opacity-50 disabled:cursor-not-allowed',
        )
        ->add($this->sizeClasses())
        ->add($this->variantClasses())
        ->when($this->square, 'aspect-square !px-0')
        ->__toString();
    }

    protected function sizeClasses(): string
    {
        return match ($this->size) {
            'xs' => 'text-xs px-2 py-1 rounded',
            'sm' => 'text-sm px-3 py-1.5 rounded-md',
            'base' => 'text-sm px-4 py-2 rounded-lg',
            'lg' => 'text-base px-5 py-2.5 rounded-lg',
            'xl' => 'text-base px-6 py-3 rounded-xl',
            default => 'text-sm px-4 py-2 rounded-lg',
        };
    }

    protected function variantClasses(): string
    {
        return match ($this->variant) {
            'primary' => 'bg-zinc-900 text-white hover:bg-zinc-800 focus-visible:ring-zinc-500 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100',
            'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:ring-red-500 dark:bg-red-500 dark:hover:bg-red-600',
            'ghost' => 'bg-transparent text-zinc-700 hover:bg-zinc-100 focus-visible:ring-zinc-500 dark:text-zinc-300 dark:hover:bg-zinc-800',
            'subtle' => 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200 focus-visible:ring-zinc-500 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700',
            'outline' => 'bg-transparent text-zinc-700 border border-zinc-300 hover:bg-zinc-50 focus-visible:ring-zinc-500 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-800',
            default => 'bg-zinc-200 text-zinc-900 hover:bg-zinc-300 focus-visible:ring-zinc-500 dark:bg-zinc-700 dark:text-zinc-100 dark:hover:bg-zinc-600', // filled
        };
    }
}

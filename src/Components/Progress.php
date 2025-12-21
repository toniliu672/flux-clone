<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Progress extends Component
{
    public function __construct(
        public int|float $value = 0,
        public int|float $max = 100,
        public string $size = 'md', // sm, md, lg
        public ?string $color = null,
        public bool $showValue = false,
        public bool $indeterminate = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.progress');
    }
}

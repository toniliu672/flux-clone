<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class TimePicker extends Component
{
    public function __construct(
        public ?string $value = null,
        public ?string $placeholder = 'Select time',
        public bool $use24h = false,
        public int $step = 30, // minutes
    ) {}

    public function render()
    {
        return view('flux-clone::components.time-picker');
    }
}

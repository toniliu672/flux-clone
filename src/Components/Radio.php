<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Radio extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $value = null,
        public bool $checked = false,
        public bool $disabled = false,
        public ?string $icon = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.radio');
    }
}

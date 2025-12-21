<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Toggle extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public bool $checked = false,
        public bool $disabled = false,
        public ?string $description = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.switch');
    }
}

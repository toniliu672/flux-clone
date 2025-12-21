<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Field extends Component
{
    public function __construct(
        public ?string $label = null,
        public ?string $name = null,
        public ?string $description = null,
        public bool $required = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.field');
    }
}

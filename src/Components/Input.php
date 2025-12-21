<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public string $type = 'text',
        public ?string $name = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $value = null,
        public bool $required = false,
        public bool $disabled = false,
        public bool $readonly = false,
        public bool $viewable = false,
        public ?string $autocomplete = null,
        public ?string $description = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.input');
    }
}

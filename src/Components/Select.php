<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public bool $disabled = false,
        public bool $searchable = false,
        public ?string $description = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.select');
    }
}

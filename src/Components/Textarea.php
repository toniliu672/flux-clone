<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $value = null,
        public int $rows = 3,
        public bool $required = false,
        public bool $disabled = false,
        public bool $readonly = false,
        public bool $resize = true,
        public ?string $description = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.textarea');
    }
}

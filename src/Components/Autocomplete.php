<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Autocomplete extends Component
{
    public function __construct(
        public array $options = [],
        public ?string $placeholder = null,
        public bool $multiple = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.autocomplete');
    }
}

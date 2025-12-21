<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Accordion extends Component
{
    public function __construct(
        public bool $multiple = false, // Allow multiple panels open
        public ?string $defaultOpen = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.accordion.index');
    }
}

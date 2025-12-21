<?php

declare(strict_types=1);

namespace FluxClone\Components\Accordion;

use Illuminate\View\Component;

class Item extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $heading = null,
        public ?string $icon = null,
        public bool $disabled = false,
    ) {}

    public function render()
    {
        return view('flux-clone::components.accordion.item');
    }
}

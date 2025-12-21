<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Calendar extends Component
{
    public function __construct(
        public ?string $value = null,
        public ?string $min = null,
        public ?string $max = null,
    ) {}

    public function render()
    {
        return view('flux-clone::components.calendar');
    }
}

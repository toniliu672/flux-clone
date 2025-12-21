<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public function __construct(
        public string $align = 'right',
        public string $position = 'bottom',
    ) {}

    public function render()
    {
        return view('flux-clone::components.dropdown');
    }
}

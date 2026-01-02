<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Popover extends Component
{
    public function __construct(
        public string $position = 'bottom', // top, bottom, left, right
        public string $align = 'center', // start, center, end
    ) {}

    public function render()
    {
        return view('flux-clone::components.popover.index');
    }
}

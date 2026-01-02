<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    public function __construct(
        public string $position = 'bottom-right', // top-left, top-center, top-right, bottom-left, bottom-center, bottom-right
    ) {}

    public function render()
    {
        return view('flux-clone::components.toast.index');
    }
}

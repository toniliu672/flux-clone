<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public function __construct(
        public string $color = 'zinc',
        public string $size = 'base',
        public string $variant = 'solid',
    ) {}

    public function render()
    {
        return view('flux-clone::components.badge');
    }
}

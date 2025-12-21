<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $name,
        public string $variant = 'outline',
    ) {}

    public function render()
    {
        return view('flux-clone::components.icon');
    }
}

<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Separator extends Component
{
    public function __construct(
        public string $variant = 'default',
        public string $orientation = 'horizontal',
    ) {}

    public function render()
    {
        return view('flux-clone::components.separator');
    }
}

<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Text extends Component
{
    public function __construct(
        public string $size = 'base',
    ) {}

    public function render()
    {
        return view('flux-clone::components.text');
    }
}

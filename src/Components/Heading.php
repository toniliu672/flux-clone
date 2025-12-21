<?php

declare(strict_types=1);

namespace FluxClone\Components;

use Illuminate\View\Component;

class Heading extends Component
{
    public function __construct(
        public string $size = 'base',
        public string $level = '2',
    ) {}

    public function render()
    {
        return view('flux-clone::components.heading');
    }
}
